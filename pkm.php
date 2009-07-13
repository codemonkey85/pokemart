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

	require_once("common.php"); // Include common functionality
	
	$pokemon = new PKM();
	if(isset($_FILES["pkmfile"]["tmp_name"])) {
		$filename = $_FILES["pkmfile"]["tmp_name"];
	}
	if(isset($_GET["pkm_url"]) && ($_GET["pkm_url"] != "")) {
		$filename = $_GET["pkm_url"];
		echo $filename;
	}
	if(isset($_POST["pkmurl"]) && ($_POST["pkmurl"] != "")) {
		$filename = $_POST["pkmurl"];
	}
	
	if($filename != "") {
		$pokemon->generateFromFile($filename);
	} else {
		$error = "PKM file is invalid";
	}

?>

<html>
<head>
<title>PKM Reader: <?=$pokemon->Name;?></title>
<style>
body {
	font-size: 12px;
}
td {
	font-size: 12px;
	padding: 10px;
}

#stats td {
	background: #DDDDDD;
	height: 20px;
	width: 75px;
	text-align: center;
	padding: 2px;
}

#moves td {
	background: #DDDDDD;
	height: 20px;
	width: 75px;
	text-align: center;
	padding: 2px;
}

#ribbons td {
	padding: 0px;
}

thead td {
	font-weight: bold;
}
</style>
</head>
<body bgcolor="#FF8000">

<?php

	if($error != "") {
	
		echo $error;
		
	} else {
	
?>

<table align="center" cellpadding="0" cellspacing="0" style="width: 800px;">
	<tr>
		<td style="background: url('images/pages/textbox_top.jpg'); height: 20px; width: 800px;"></td>
	</tr>
	<tr>
		<td style="background: url('images/pages/textbox_middle.jpg');">

			<div style="padding-left: 50px; padding-top: 5px; padding-right: 50px; font-family: Tahoma, Verdana, Arial, Helvetica; font-size: 12px;">		
		
		<!-- INTERNAL TABLE -->
		
		<a href="index.php">&lt;&lt; Go Back and Upload Another</a>

	<table>
		<tr>
			<td colspan="2">
				<h1><?=$pokemon->Name;?></h1>
			</td>
			<td align="center" rowspan="2" valign="top">
				<img src="images/pokemon/<?=$pokemon->Pokedex["National"];?>.png" /><br>
				<?php
					foreach($pokemon->Types as $key => $Type) {
						echo '<img src="images/types/'.$Type.'.gif" /> ';
					}
				?>
			</td>
		</tr>
		<tr>
			<td valign="top">
				<strong>General Info</strong><br />
				Nickname: <?=$pokemon->Nickname;?><br />
				Experience Points: <?=number_format($pokemon->ExperiencePoints, 0, "", ",");?><br />
				Level: <?=$pokemon->Level;?><br />
				Growth Rate: <?=$pokemon->Growth["Name"];?><br />
				PID: <?=$pokemon->PID;?><br />
				Nature: <?=$pokemon->Nature["Name"];?><br />
				Ability: <?=$pokemon->Ability["Name"];?><br />
				Gender: <?=$pokemon->Gender;?><br />
				Held Item: <?=$pokemon->HeldItem["Name"];?><br />
				Friendship: <?=$pokemon->Friendship;?><br />
				<br />
				
				<strong>Pokedex Numbers</strong><br />
					<?php
						foreach($pokemon->Pokedex as $Pokedex => $Place) {
							echo $Pokedex.': '.$Place.'<br />';
						}
					?>
				<br />
			</td>
			<td valign="top">
				<strong>Trainer / Meeting Info</strong><br />
				OT ID: <?=$pokemon->OriginalTrainer["ID"];?><br />
				OT Name: <?=$pokemon->OriginalTrainer["Name"];?><br />
				OT Gender: <?=$pokemon->OriginalTrainer["Gender"];?><br />
				Secret ID: <?=$pokemon->SecretID;?><br />
				Date Met: <?=$pokemon->DateMetWords;?><br />
				Home Town: <?=$pokemon->HomeTown;?><br />
				Area Met: <?=$pokemon->AreaMet["Name"];?><br />
				Met At Level: <?=$pokemon->MetAtLevel;?><br />
				Pokeball Type: <?=$pokemon->Pokeball["Name"]?><br />
				<br />
				
				<strong>Other Info</strong><br />
				Country Of Origin: <?=$pokemon->Country["Name"];?><br />
				Pokerus: <?=$pokemon->Pokerus;?><br />
				Fateful Encounter: <?=$pokemon->FatefulEncounter;?><br />
				<br />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<h2>Stats</h2>
				<table id="stats">
					<thead>
						<tr>
							<td style="width: 150px;"></td>
							<td>HP</td>
							<td>ATT</td>
							<td>DEF</td>
							<td>SP ATT</td>
							<td>SP DEF</td>
							<td>SPEED</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Base Stats:</td>
							<td><?=$pokemon->BaseStats["HP"];?></td>
							<td><?=$pokemon->BaseStats["Attack"];?></td>
							<td><?=$pokemon->BaseStats["Defense"];?></td>
							<td><?=$pokemon->BaseStats["SpecialAttack"];?></td>
							<td><?=$pokemon->BaseStats["SpecialDefense"];?></td>
							<td><?=$pokemon->BaseStats["Speed"];?></td>
						</tr>
						<tr>
							<td>Individual Values:</td>
							<td><?=$pokemon->IndividualValues["HP"];?></td>
							<td><?=$pokemon->IndividualValues["Attack"];?></td>
							<td><?=$pokemon->IndividualValues["Defense"];?></td>
							<td><?=$pokemon->IndividualValues["SpecialAttack"];?></td>
							<td><?=$pokemon->IndividualValues["SpecialDefense"];?></td>
							<td><?=$pokemon->IndividualValues["Speed"];?></td>
						</tr>
						<tr>
							<td>Effort Values:</td>
							<td><?=$pokemon->EffortValues["HP"];?></td>
							<td><?=$pokemon->EffortValues["Attack"];?></td>
							<td><?=$pokemon->EffortValues["Defense"];?></td>
							<td><?=$pokemon->EffortValues["SpecialAttack"];?></td>
							<td><?=$pokemon->EffortValues["SpecialDefense"];?></td>
							<td><?=$pokemon->EffortValues["Speed"];?></td>
						</tr>
						<tr>
							<td>Calc. Stats:</td>
							<td><?=$pokemon->CalcStats["HP"];?></td>
							<td><?=$pokemon->CalcStats["Attack"];?></td>
							<td><?=$pokemon->CalcStats["Defense"];?></td>
							<td><?=$pokemon->CalcStats["SpecialAttack"];?></td>
							<td><?=$pokemon->CalcStats["SpecialDefense"];?></td>
							<td><?=$pokemon->CalcStats["Speed"];?></td>
						</tr>
					</tbody>
				</table>
				<br />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<h2>Moves</h2>
				<table id="moves">
					<thead>
						<tr>
							<td style="width: 150px;">Name</td>
							<td>Power</td>
							<td>Accuracy</td>
							<td>PP</td>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach($pokemon->Moves as $key => $Move) {
								echo	'<tr>
											<td>'.$Move["Name"].'</td>
											<td>'.$Move["Power"].'</td>
											<td>'.$Move["Accuracy"].'</td>
											<td>'.$Move["RemainingPP"].' / '.$Move["CalculatedMaxPP"].'</td>
										</tr>';
							}
						?>
					</tbody>
				</table>
				<br />
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<h2>Ribbons</h2>
				<table id="ribbons">
				<?php
					foreach($pokemon->Ribbons as $key => $Ribbon) {
						echo '<tr><td><img src="images/ribbons/'.str_replace(" ", "", $Ribbon).'.png" /></td>';
						echo '<td>&nbsp;'.$Ribbon.'</td></tr>';
					}
				?>
				</table>
			</td>
		</tr>
</table>

		<a href="index.php">&lt;&lt; Go Back and Upload Another</a>

	</div>

		</td>
	</tr>
	<tr>
		<td style="background: url('images/pages/textbox_bottom.jpg'); height: 25px; width: 800px;"></td>
	</tr>
</table>

<?php

}

?>

</body>
</html>