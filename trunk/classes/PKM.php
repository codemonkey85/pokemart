<?php

/*

	© Copyright 2009 Andy Leon <andy@thepokemart.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
*/

	require_once('common.php'); // Include common functionality
	require_once("expfunctions.php"); // Include experience calcs

	class PKM {
	
		private $fontTable = Array();
		private $pkmHeader = Array();
		private $blockA = Array();
		private $blockB = Array();
		private $blockC = Array();
		private $blockD = Array();
		
		public $NatDexNumber = 0;	
		public $Name = "";
		public $PID = 0;
		public $IsNicknamed = 0;
		public $IsEgg = 0;
		public $FatefulEncounter = 0;
		public $Gender = "";
		public $ExperiencePoints = 0;
		public $Friendship = 0;
		public $DateMetUnix = 0;
		public $DateMetWords = "";
		public $HomeTown = "";
		public $SecretID = 0;
		public $Pokerus = 0;
		public $Level = 0;
		public $MetAtLevel = 0;

		public $Growth = Array();
		public $Pokedex = Array();
		public $HeldItem = Array();		
		public $Moves = Array();
		public $Nature = Array();
		public $OriginalTrainer = Array();
		public $Pokeball = Array();
		public $BaseStats = Array();
		public $AreaMet = Array();
		public $IndividualValues = Array();
		public $EffortValues = Array();
		public $Ribbons = Array();
		public $Types = Array();
		public $CalcStats = Array();
		public $Country = Array();
				
		public function __construct() {
			// Open font-table and load into an array
			$fontFile = fopen("resources/fonts/html.txt", "r");
			while($line = fgets($fontFile)) {
				$line_split = explode("=", $line);
				$this->fontTable[$line_split[0]] = $line_split[1];
			}
		}
					
		public function generateFromFile($pkmFile) {
			$blockA_format = "v1SPECIES/v1HeldItem/v1OrigTrainer/v1SECRETID/V1EXP/C1FRIENDSHIP/C1Ability/C1Markings/C1COUNTRY/C6EFFORTVALS/C6CS/C4RIBBONS";
			$blockB_format = "v4MoveNumber/C4MovePP/C4MovePPUps/V1SPECIAL1/C4RIBBONS/v1SPECIAL2/v1Unknown2/v1PEggLoc/v1PMet";
			$blockC_format = "H44NICKNAME/C1Unknown/C1HOMETOWN/V1Contests/V1Unknown3";
			$blockD_format = "H32OTName/C3DER/C3DM/v1DPEL/v1DPMAL/C1Pokerus/C1POKEBALL/C1SPECIAL3/C1Encounter/v1Unknown4";
			$fileHandler = fopen($pkmFile, "rb");
			$this->pkmHeader = unpack("v2PID/n1unknown/v1Checksum", fread($fileHandler, 8));
			$this->blockA = unpack($blockA_format, fread($fileHandler, 32));
			$this->blockB = unpack($blockB_format, fread($fileHandler, 32));
			$this->blockC = unpack($blockC_format, fread($fileHandler, 32));
			$this->blockD = unpack($blockD_format, fread($fileHandler, 32));
			$this->processBlocks();
			// $this->printArray();
		}
		
		public function pkmStringToRegular($input) {
			// Takes hexadecimal string and runs it through
			// the font-table to convert it to Pokemon text
			for($i = 0; $i < strlen($input); $i++) {
				$n = $i * 4;
				$char = $input[$n+2];
				$char .= $input[$n+3];
				$char .= $input[$n];
				$char .= $input[$n+1];
				$output .= $this->fontTable[strtoupper($char)];
			}
			$output = str_replace("\r", "", $output);
			$output = str_replace("\n", "", $output);
			return $output;
		}

		public function processBlocks() {
			global $dbconn;
			
			// PID
			$this->PID = (float)(($this->pkmHeader["PID2"] * 65536) + $this->pkmHeader["PID1"]);
			
			// NATURE
			$this->Nature["Number"] = fmod($this->PID, 25);
			if($this->Nature["Number"] > 0) {
				$Natures = mysql_query("select * from natures where number = ".$this->Nature["Number"]);
				$this->Nature["Name"] = mysql_result($Natures, 0, "nname");
				$this->Nature["Attack"] = mysql_result($Natures, 0, "attack");
				$this->Nature["Defense"] = mysql_result($Natures, 0, "defense");
				$this->Nature["SpecialAttack"] = mysql_result($Natures, 0, "spattack");
				$this->Nature["SpecialDefense"] = mysql_result($Natures, 0, "spdefense");
				$this->Nature["Speed"] = mysql_result($Natures, 0, "speed");
				$this->Nature["Likes"] = mysql_result($Natures, 0, "likes");
				$this->Nature["Dislikes"] = mysql_result($Natures, 0, "dislikes");
			}
			
			// FRIENDSHIP
			$this->Friendship = $this->blockA["FRIENDSHIP"];
			
			// GENERAL POKEMON INFO
			$internals = mysql_query("select * from pokedex_numbers where dexid = 1 and place = ".$this->blockA["SPECIES"]);
			$this->InternalID = mysql_result($internals, 0, "pokid");
			$dex_numbers = mysql_query("select * from pokedex_numbers inner join pokedex on dexid = pokedex.id where pokid = ".$this->InternalID);
			for($i = 0; $i < mysql_num_rows($dex_numbers); $i++) {
				$this->Pokedex[mysql_result($dex_numbers, $i, "dname")] = mysql_result($dex_numbers, $i, "place");
			}
			
			$result = mysql_query("select * from pokemon where id = ".$this->InternalID);
			$this->Name = mysql_result($result, 0, "pname");
			// Base Stats
			$this->BaseStats["HP"] = mysql_result($result, 0, "base_hp");
			$this->BaseStats["Attack"] = mysql_result($result, 0, "base_att");
			$this->BaseStats["Defense"] = mysql_result($result, 0, "base_def");
			$this->BaseStats["SpecialAttack"] = mysql_result($result, 0, "base_sp_att");
			$this->BaseStats["SpecialDefense"] = mysql_result($result, 0, "base_sp_def");
			$this->BaseStats["Speed"] = mysql_result($result, 0, "base_speed");
			// Types
			if(mysql_result($result, 0, "type1") != "None") $this->Types[] = mysql_result($result, 0, "type1");
			if(mysql_result($result, 0, "type2") != "None") $this->Types[] = mysql_result($result, 0, "type2");
			// Height and Weight
			$this->Height = mysql_result($result, 0, "height");
			$this->Weight = mysql_result($result, 0, "weight");
			// Nickname
			$this->Nickname = $this->pkmStringToRegular($this->blockC["NICKNAME"]);
			// Growth
			$this->Growth["Number"] = mysql_result($result, 0, "growth");
			switch($this->Growth["Number"]) {
				case 0: $this->Growth["Name"] = "Erratic"; break;
				case 1: $this->Growth["Name"] = "Fast"; break;
				case 2: $this->Growth["Name"] = "Medium-Fast"; break;
				case 3: $this->Growth["Name"] = "Medium-Slow"; break;
				case 4: $this->Growth["Name"] = "Slow"; break;
				case 5: $this->Growth["Name"] = "Fluctuating"; break;
			}

			// SECRET ID
			$this->SecretID = $this->blockA["SECRETID"];
			
			// EXPERIENCE POINTS
			$this->ExperiencePoints = $this->blockA["EXP"];
			$this->Level = getLevelFromExp($this->ExperiencePoints, $this->Growth["Number"]);
			
			// ORIGINAL TRAINER INFO
			$this->OriginalTrainer["ID"] = $this->blockA["OrigTrainer"];
			$this->OriginalTrainer["Name"] = $this->pkmStringToRegular($this->blockD["OTName"]);
			
			// COUNTRY
			$this->Country["Number"] = $this->blockA["COUNTRY"];
			switch($this->Country["Number"]) {
				case 1: $this->Country["Name"] = "Japan"; break;
				case 2: $this->Country["Name"] = "US / UK / Aus"; break;
				case 3: $this->Country["Name"] = "France"; break;
				case 4: $this->Country["Name"] = "Italy"; break;
				case 5: $this->Country["Name"] = "Germany"; break;
				case 6: $this->Country["Name"] = "Spain"; break;
				case 7: $this->Country["Name"] = "Korea"; break;
			}
			
			// MOVE INFORMATION
			for($i = 1; $i < 5; $i++) {
				$result = mysql_query("select * from attacks where number = ".$this->blockB["MoveNumber".$i]);
				if(mysql_num_rows($result) > 0) {
					$this->Moves[$i]["Number"] = $this->blockB["MoveNumber".$i];
					$this->Moves[$i]["Name"] = mysql_result($result, 0, "aname");
					$this->Moves[$i]["NormalMaxPP"] = mysql_result($result, 0, "PP");
					$this->Moves[$i]["AddedPP"] = $this->blockB["MovePPUps".$i];
					$this->Moves[$i]["CalculatedMaxPP"] = $this->Moves[$i]["NormalMaxPP"] + $this->Moves[$i]["AddedPP"];
					$this->Moves[$i]["RemainingPP"] = $this->blockB["MovePP".$i];
					$this->Moves[$i]["Power"] = mysql_result($result, 0, "power");
					$this->Moves[$i]["Accuracy"] = mysql_result($result, 0, "accuracy");
				}
			}
			
			// ABILITY INFO
			$this->Ability["Number"] = $this->blockA["Ability"];
			if($this->Ability["Number"] > 0) {
				$result = mysql_query("select * from abilities where number = ".$this->Ability["Number"]);
				$this->Ability["Name"] = mysql_result($result, 0, "aname");
			} else $this->Ability["Name"] = "None";
			
			// POKERUS (POKEMON VIRUS)
			$this->Pokerus = $this->blockD["Pokerus"];
			
			// POKEBALL
			$this->Pokeball["Number"] = $this->blockD["POKEBALL"];
			switch($this->Pokeball["Number"]) {
				case 1: $this->Pokeball["Name"] = "Master Ball"; break;
				case 2: $this->Pokeball["Name"] = "Ultra Ball"; break;
				case 3: $this->Pokeball["Name"] = "Great Ball"; break;
				case 4: $this->Pokeball["Name"] = "Poke Ball"; break;
				case 5: $this->Pokeball["Name"] = "Safari Ball"; break;
				case 6: $this->Pokeball["Name"] = "Net Ball"; break;
				case 7: $this->Pokeball["Name"] = "Dive Ball"; break;
				case 8: $this->Pokeball["Name"] = "Nest Ball"; break;
				case 9: $this->Pokeball["Name"] = "Repeat Ball"; break;
				case 10: $this->Pokeball["Name"] = "Timer Ball"; break;
				case 11: $this->Pokeball["Name"] = "Luxury Ball"; break;
				case 12: $this->Pokeball["Name"] = "Premier Ball"; break;
				case 13: $this->Pokeball["Name"] = "Dusk Ball"; break;
				case 14: $this->Pokeball["Name"] = "Heal Ball"; break;
				case 15: $this->Pokeball["Name"] = "Quick Ball"; break;
				case 16: $this->Pokeball["Name"] = "Cherish Ball"; break;
			}

			// DATE MET
			$this->DateMetUnix = mktime(0, 0, 0, $this->blockD["DM2"], $this->blockD["DM3"], $this->blockD["DM1"] + 2000);
			$this->DateMetWords = date("jS F Y", $this->DateMetUnix);
			
			// AREA MET
			$this->AreaMet["Number"] = $this->blockD["DPMAL"];
			$locations = mysql_query("select * from locations where number = ".$this->AreaMet["Number"]);
			$this->AreaMet["Name"] = mysql_result($locations, 0, "lname");
				
			// HOME TOWN			
			switch($this->blockC["HOMETOWN"]) {
				case 1: $this->HomeTown = "Hoenn (Sapphire)"; break;
				case 2: $this->HomeTown = "Hoenn (Ruby)"; break;
				case 3: $this->HomeTown = "Hoenn (Emerald)"; break;
				case 4: $this->HomeTown = "Kanto (Fire Red)"; break;
				case 5: $this->HomeTown = "Kanto (Leaf Green)"; break;
				case 7: $this->HomeTown = "Johto (Gold)"; break;
				case 8: $this->HomeTown = "Johto (Silver)"; break;
				case 10: $this->HomeTown = "Sinnoh (Diamond)"; break;
				case 11: $this->HomeTown = "Sinnoh (Pearl)"; break;
				case 12: $this->HomeTown = "Sinnoh (Platinum)"; break;
				case 15: $this->HomeTown = "Orre (Colosseum)"; break;
				default: $this->HomeTown = "Unknown";
			}
			
			// HELD ITEM
			$this->HeldItem["Number"] = $this->blockA["HeldItem"];
			if($this->HeldItem["Number"] > 0) {
				$items = mysql_query("select * from items where number = ".$this->HeldItem["Number"]);
				$this->HeldItem["Name"] = mysql_result($items, 0, "iname");
			} else {
				$this->HeldItem["Name"] = "None";
			}
			
			// EFFORT VALUES
			$this->EffortValues["HP"] = intval($this->blockA["EFFORTVALS1"]);
			$this->EffortValues["Attack"] = intval($this->blockA["EFFORTVALS2"]);
			$this->EffortValues["Defense"] = intval($this->blockA["EFFORTVALS3"]);
			$this->EffortValues["SpecialAttack"] = intval($this->blockA["EFFORTVALS4"]);
			$this->EffortValues["SpecialDefense"] = intval($this->blockA["EFFORTVALS5"]);
			$this->EffortValues["Speed"] = intval($this->blockA["EFFORTVALS6"]);
			
			// SPECIAL1 - CONTROLS INDIVIDUAL VALUES, AND WHETHER THE POKEMON IS NICKNAMED OR AN EGG
			// Are these figures right - might need to compensate for little endian order
			$special1 = str_pad(decbin($this->blockB["SPECIAL1"]), 32, 0, STR_PAD_LEFT);
			$this->IndividualValues["HP"] = bindec(substr($special1, 0, 5));
			$this->IndividualValues["Attack"] = bindec(substr($special1, 5, 5));
			$this->IndividualValues["Defense"] = bindec(substr($special1, 10, 5));
			$this->IndividualValues["SpecialAttack"] = bindec(substr($special1, 15, 5));
			$this->IndividualValues["SpecialDefense"] = bindec(substr($special1, 20, 5));
			$this->IndividualValues["Speed"] = bindec(substr($special1, 25, 5));
			$this->IsNicknamed = intval(substr($special1, 30, 1));
			$this->IsEgg = intval(substr($special1, 31, 1));
			
			// SPECIAL 2 - CONTROLS FATEFUL ENCOUNTER, GENDER AND ALTERNATE FORMS
			// See note above on little endian order
			$special2 = str_pad(decbin($this->blockB["SPECIAL2"]), 16, 0, STR_PAD_RIGHT);
			$this->FatefulEncounter = intval(substr($special2, 0, 1));
			$female = intval(substr($special2, 1, 1));
			$genderless = intval(substr($special2, 2, 1));
			if($female == 1) $this->Gender = "Female";
			elseif($genderless == 1) $this->Gender = "Genderless";
			else $this->Gender = "Male";
			// Code not written for alternate forms yet
			
			// SPECIAL 3
			$special3 = str_pad(decbin($this->blockD["SPECIAL3"]), 8, 0, STR_PAD_LEFT);
			if(intval(substr($special3, 0, 1)) == 1) $this->OriginalTrainer["Gender"] = "Female";
			else $this->OriginalTrainer["Gender"] = "Male";
			$this->MetAtLevel = bindec(substr($special3, 1, 7));
			
			// RIBBONS
			$ribbons1 = str_pad(decbin($this->blockA["RIBBONS1"]), 8, 0, STR_PAD_LEFT);
			$ribbons2 = str_pad(decbin($this->blockA["RIBBONS2"]), 8, 0, STR_PAD_LEFT);
			$ribbons3 = str_pad(decbin($this->blockA["RIBBONS3"]), 8, 0, STR_PAD_LEFT);
			$ribbons4 = str_pad(decbin($this->blockA["RIBBONS4"]), 8, 0, STR_PAD_LEFT);
			$ribbons5 = str_pad(decbin($this->blockB["RIBBONS1"]), 8, 0, STR_PAD_LEFT);
			$ribbons6 = str_pad(decbin($this->blockB["RIBBONS2"]), 8, 0, STR_PAD_LEFT);
			$ribbons7 = str_pad(decbin($this->blockB["RIBBONS3"]), 8, 0, STR_PAD_LEFT);
			$ribbons8 = str_pad(decbin($this->blockB["RIBBONS4"]), 8, 0, STR_PAD_LEFT);
			// BLOCK 1 - BYTE 0x24
			if(intval(substr($ribbons2, 7, 1)) == 1) $this->Ribbons[] = "Shock Ribbon";
			if(intval(substr($ribbons2, 6, 1)) == 1) $this->Ribbons[] = "Downcast Ribbon";
			if(intval(substr($ribbons2, 5, 1)) == 1) $this->Ribbons[] = "Careless Ribbon";
			if(intval(substr($ribbons2, 4, 1)) == 1) $this->Ribbons[] = "Relax Ribbon";
			if(intval(substr($ribbons2, 3, 1)) == 1) $this->Ribbons[] = "Snooze Ribbon";
			if(intval(substr($ribbons2, 2, 1)) == 1) $this->Ribbons[] = "Smile Ribbon";
			if(intval(substr($ribbons2, 1, 1)) == 1) $this->Ribbons[] = "Gorgeous Ribbon";
			if(intval(substr($ribbons2, 0, 1)) == 1) $this->Ribbons[] = "Royal Ribbon";
			// BLOCK 2 - BYTE 0x25
			if(intval(substr($ribbons1, 7, 1)) == 1) $this->Ribbons[] = "Sinnoh Champ Ribbon";
			if(intval(substr($ribbons1, 6, 1)) == 1) $this->Ribbons[] = "Ability Ribbon";
			if(intval(substr($ribbons1, 5, 1)) == 1) $this->Ribbons[] = "Great Ability Ribbon";
			if(intval(substr($ribbons1, 4, 1)) == 1) $this->Ribbons[] = "Double Ability Ribbon";
			if(intval(substr($ribbons1, 3, 1)) == 1) $this->Ribbons[] = "Multi Ability Ribbon";
			if(intval(substr($ribbons1, 2, 1)) == 1) $this->Ribbons[] = "Pair Ability Ribbon";
			if(intval(substr($ribbons1, 1, 1)) == 1) $this->Ribbons[] = "World Ability Ribbon";
			if(intval(substr($ribbons1, 0, 1)) == 1) $this->Ribbons[] = "Alert Ribbon";
			// BLOCK 3 - BYTE 0x26
			if(intval(substr($ribbons3, 7, 1)) == 1) $this->Ribbons[] = "Gorgeous Royal Ribbon";
			if(intval(substr($ribbons3, 6, 1)) == 1) $this->Ribbons[] = "Footprint Ribbon";
			if(intval(substr($ribbons3, 5, 1)) == 1) $this->Ribbons[] = "Record Ribbon";
			if(intval(substr($ribbons3, 4, 1)) == 1) $this->Ribbons[] = "History Ribbon";
			if(intval(substr($ribbons3, 3, 1)) == 1) $this->Ribbons[] = "Legend Ribbon";
			if(intval(substr($ribbons3, 2, 1)) == 1) $this->Ribbons[] = "Red Ribbon";
			if(intval(substr($ribbons3, 1, 1)) == 1) $this->Ribbons[] = "Green Ribbon";
			if(intval(substr($ribbons3, 0, 1)) == 1) $this->Ribbons[] = "Blue Ribbon";
			// BLOCK 4 - BYTE 0x27
			if(intval(substr($ribbons4, 7, 1)) == 1) $this->Ribbons[] = "Festival Ribbon";
			if(intval(substr($ribbons4, 6, 1)) == 1) $this->Ribbons[] = "Carnival Ribbon";
			if(intval(substr($ribbons4, 5, 1)) == 1) $this->Ribbons[] = "Classic Ribbon";
			if(intval(substr($ribbons4, 4, 1)) == 1) $this->Ribbons[] = "Premier Ribbon";
			// BLOCK 5 - BYTE 0x3C
			if(intval(substr($ribbons6, 7, 1)) == 1) $this->Ribbons[] = "Cute Ribbon";
			if(intval(substr($ribbons6, 6, 1)) == 1) $this->Ribbons[] = "Cute Ribbon Super";
			if(intval(substr($ribbons6, 5, 1)) == 1) $this->Ribbons[] = "Cute Ribbon Hyper";
			if(intval(substr($ribbons6, 4, 1)) == 1) $this->Ribbons[] = "Cute Ribbon Master";
			if(intval(substr($ribbons6, 3, 1)) == 1) $this->Ribbons[] = "Smart Ribbon";
			if(intval(substr($ribbons6, 2, 1)) == 1) $this->Ribbons[] = "Smart Ribbon Super";
			if(intval(substr($ribbons6, 1, 1)) == 1) $this->Ribbons[] = "Smart Ribbon Hyper";
			if(intval(substr($ribbons6, 0, 1)) == 1) $this->Ribbons[] = "Smart Ribbon Master";
			// BLOCK 6 - BYTE 0x3D
			if(intval(substr($ribbons5, 7, 1)) == 1) $this->Ribbons[] = "Cool Ribbon";
			if(intval(substr($ribbons5, 6, 1)) == 1) $this->Ribbons[] = "Cool Ribbon Super";
			if(intval(substr($ribbons5, 5, 1)) == 1) $this->Ribbons[] = "Cool Ribbon Hyper";
			if(intval(substr($ribbons5, 4, 1)) == 1) $this->Ribbons[] = "Cool Ribbon Master";
			if(intval(substr($ribbons5, 3, 1)) == 1) $this->Ribbons[] = "Beauty Ribbon";
			if(intval(substr($ribbons5, 2, 1)) == 1) $this->Ribbons[] = "Beauty Ribbon Super";
			if(intval(substr($ribbons5, 1, 1)) == 1) $this->Ribbons[] = "Beauty Ribbon Hyper";
			if(intval(substr($ribbons5, 0, 1)) == 1) $this->Ribbons[] = "Beauty Ribbon Master";
			// BLOCK 7 - BYTE 0x3E
			if(intval(substr($ribbons8, 7, 1)) == 1) $this->Ribbons[] = "Effort Ribbon";
			if(intval(substr($ribbons8, 6, 1)) == 1) $this->Ribbons[] = "Marine Ribbon";
			if(intval(substr($ribbons8, 5, 1)) == 1) $this->Ribbons[] = "Land Ribbon";
			if(intval(substr($ribbons8, 4, 1)) == 1) $this->Ribbons[] = "Sky Ribbon";
			if(intval(substr($ribbons8, 3, 1)) == 1) $this->Ribbons[] = "Country Ribbon";
			if(intval(substr($ribbons8, 2, 1)) == 1) $this->Ribbons[] = "National Ribbon";
			if(intval(substr($ribbons8, 1, 1)) == 1) $this->Ribbons[] = "Earth Ribbon";
			if(intval(substr($ribbons8, 0, 1)) == 1) $this->Ribbons[] = "World Ribbon";
			// BLOCK 8 - BYTE 0x3F
			if(intval(substr($ribbons7, 7, 1)) == 1) $this->Ribbons[] = "Tough Ribbon";
			if(intval(substr($ribbons7, 6, 1)) == 1) $this->Ribbons[] = "Tough Ribbon Super";
			if(intval(substr($ribbons7, 5, 1)) == 1) $this->Ribbons[] = "Tough Ribbon Hyper";
			if(intval(substr($ribbons7, 4, 1)) == 1) $this->Ribbons[] = "Tough Ribbon Master";
			if(intval(substr($ribbons7, 3, 1)) == 1) $this->Ribbons[] = "Champion Ribbon";
			if(intval(substr($ribbons7, 2, 1)) == 1) $this->Ribbons[] = "Winning Ribbon";
			if(intval(substr($ribbons7, 1, 1)) == 1) $this->Ribbons[] = "Victory Ribbon";
			if(intval(substr($ribbons7, 0, 1)) == 1) $this->Ribbons[] = "Artist Ribbon";
			
			// EARLY ATTEMPT TO CREATE CALCULATED STATS
			$this->CalcStats["HP"] = floor((($this->IndividualValues["HP"] + (2 * $this->BaseStats["HP"]) + ($this->EffortValues["HP"] / 4)) * ($this->Level / 100)) + 10 + $this->Level);
			$this->CalcStats["Attack"] = floor(((($this->IndividualValues["Attack"] + (2 * $this->BaseStats["Attack"]) + ($this->EffortValues["Attack"] / 4)) * ($this->Level / 100)) + 5) * $this->Nature["Attack"]);
			$this->CalcStats["Defense"] = floor(((($this->IndividualValues["Defense"] + (2 * $this->BaseStats["Defense"]) + ($this->EffortValues["Defense"] / 4)) * ($this->Level / 100)) + 5) * $this->Nature["Defense"]);
			$this->CalcStats["SpecialAttack"] = floor(((($this->IndividualValues["SpecialAttack"] + (2 * $this->BaseStats["SpecialAttack"]) + ($this->EffortValues["SpecialAttack"] / 4)) * ($this->Level / 100)) + 5) * $this->Nature["SpecialAttack"]);
			$this->CalcStats["SpecialDefense"] = floor(((($this->IndividualValues["SpecialDefense"] + (2 * $this->BaseStats["SpecialDefense"]) + ($this->EffortValues["SpecialDefense"] / 4)) * ($this->Level / 100)) + 5) * $this->Nature["SpecialDefense"]);
			$this->CalcStats["Speed"] = floor(((($this->IndividualValues["Speed"] + (2 * $this->BaseStats["Speed"]) + ($this->EffortValues["Speed"] / 4)) * ($this->Level / 100)) + 5) * $this->Nature["Speed"]);
		}
			
		public function printArray() {
			print_r($this->pkmHeader);
			echo '<br /><br />';
			print_r($this->blockA);
			echo '<br /><br />';
			print_r($this->blockB);
			echo '<br /><br />';
			print_r($this->blockC);
			echo '<br /><br />';
			print_r($this->blockD);
			echo '<br /><br />';
			print_r($this->Ribbons);
		}
	
	}
	
?>
