-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2009 at 05:36 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pokemon`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE IF NOT EXISTS `abilities` (
  `id` int(11) NOT NULL auto_increment,
  `number` int(11) default NULL,
  `aname` tinytext,
  `description1` mediumtext,
  `description2` mediumtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `number`, `aname`, `description1`, `description2`) VALUES
(1, 1, 'Stench', 'The stench helps keep wild Pok&eacute;mon away.', ''),
(2, 2, 'Drizzle', 'The Pok&eacute;mon makes it rain if it appears in battle.', 'Weather changes to Heavy Rain when the Pok&eacute;mon enters the battle.'),
(3, 3, 'Speed Boost', 'The Pok&eacute;mon&#x2019;s Speed stat is gradually boosted.', 'Speed increases by one stage each turn except the turn that the Pok&eacute;mon is switched into battle.'),
(4, 4, 'Battle Armor', 'The Pok&eacute;mon is protected against critical hits.', 'Opponent&#x2019;s moves cannot Critical Hit.'),
(5, 5, 'Sturdy', 'The Pok&eacute;mon is protected against &#x31;-hit KO attacks.', 'The Pok&eacute;mon is unaffected by One Hit Knock Out moves.'),
(6, 6, 'Damp', 'Prevents combatants from self destructing.', 'Explosion and Selfdestruct will not work while the Pok&eacute;mon is on the field.'),
(7, 7, 'Limber', 'The Pok&eacute;mon is protected from paralysis.', 'The Pok&eacute;mon cannot be PARALYZE condition while having this ability.'),
(8, 8, 'Sand Veil', 'Boosts the Pok&eacute;mon&#x2019;s evasion in a sandstorm.', 'Raises the Pok&eacute;mon&#x2019;s evasion during a sandstorm by one level.'),
(9, 9, 'Static', 'Contact with the Pok&eacute;mon may cause paralysis.', 'The opponent has a 30% chance of being induced with PARALYZE when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(10, 10, 'Volt Absorb', 'Restores HP if hit by an Electric-type move.', 'The Pok&eacute;mon heals up to 1/4 of it&#x2019;s maximum Hit Points when hit with Electric-type moves.'),
(11, 11, 'Water Absorb', 'Restores HP if hit by a Water-type move.', 'The Pok&eacute;mon heals up to 1/4 of it&#x2019;s maximum Hit Points when hit with Water-type moves.'),
(12, 12, 'Oblivious', 'Prevents the Pok&eacute;mon from becoming infatuated.', 'The Pok&eacute;mon cannot be ATTRACT condition while having this ability.'),
(13, 13, 'Cloud Nine', 'Eliminates the effects of weather.', 'All weather effects are negated while the Pok&eacute;mon is on the field.'),
(14, 14, 'Compoundeyes', 'The Pok&eacute;mon&#x2019;s accuracy is boosted.', 'Raises the Pok&eacute;mon&#x2019;s accuracy by 30%.'),
(15, 15, 'Insomnia', 'Prevents the Pok&eacute;mon from falling asleep.', 'The Pok&eacute;mon cannot be SLEEP condition while having this ability.'),
(16, 16, 'Color Change', 'Changes the Pok&eacute;mon&#x2019;s type to the foe&#x2019;s move.', 'This Pok&eacute;mon&#x2019;s type becomes the type of the last damaging move which hit it.'),
(17, 17, 'Immunity', 'Prevents the Pok&eacute;mon from getting poisoned.', 'The Pok&eacute;mon cannot be POISON condition while having this ability.'),
(18, 18, 'Flash Fire', 'Powers up Fire-type moves if hit by a fire move.', 'Activates when user is hit by a damaging Fire-type move (including Fire-type Hidden Power). Once activatedCOMMAuser&#x2019;s Fire-type moves deal 1.5 times damage. While this ability is in effectCOMMAthis Pok&eacute;mon is immune to damage from Fire-type attacks and Fire-type Hidden Power (accuracy and effect from these moves are ignored). For Fire-type Pok&eacute;mon with this abilityCOMMAWill-O-Wisp activates this ability without having an effect. If a non-Fire-type Pok&eacute;mon has this abilityCOMMAWill-O-Wisp will activate the ability and will have an effect.'),
(19, 19, 'Shield Dust', 'Blocks the added effects of attacks taken.', 'Damaging moves used by the opponent will not have an additional effect.'),
(20, 20, 'Own Tempo', 'Prevents the Pok&eacute;mon from becoming confused.', 'The Pok&eacute;mon cannot be Confused while having this ability.'),
(21, 21, 'Suction Cups', 'Negates moves that force switching out.', 'If the Pok&eacute;mon is in the lead spotCOMMAwhen fishingCOMMAPok&eacute;mon are easier to catch.'),
(22, 22, 'Intimidate', 'Lowers the foe&#x2019;s Attack stat.', 'Upon entering battleCOMMAthe opponent&#x2019;s Attack lowers one stage. In a Double BattleCOMMAboth opponents&#x2019; Attack are lowered. Pok&eacute;mon with the Clear BodyCOMMAHyper CutterCOMMAor White Smoke ability are unaffected. In a link battleCOMMAif both sides switch on the same turnCOMMAand first player sends out a Pok&eacute;mon with IntimidateCOMMAthe opponent&#x2019;s Attack will be lowered before the opponent&#x2019;s Pok&eacute;mon switches.'),
(23, 23, 'Shadow Tag', 'Prevents the foe from escaping.', 'The opponent cannot run nor switch. If this Pok&eacute;mon switchesCOMMAthe opponent will remain trapped. The opponent may still switch by using Baton Pass.'),
(24, 24, 'Rough Skin', 'Inflicts damage to the foe on contact.', 'The opponent is hurt by 1/16th of his maxium Hit Points of recoil when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(25, 25, 'Wonder Guard', 'Only supereffective moves will hit.', 'The Pok&eacute;mon is only harmed by Super Effective damageCOMMAweather effects and condition effects.'),
(26, 26, 'Levitate', 'Gives full immunity to all Ground-type moves.', 'Damage dealing Ground-type moves have no effect on this Pok&eacute;mon. Cannot be trapped by Arena Trap ability. Takes no damage from Spikes.'),
(27, 27, 'Effect Spore', 'Contact may paralyzeCOMMApoisonCOMMAor cause sleep.', 'The opponent has a 10% chance of being induced by PARALYZECOMMAPOISONCOMMAor SLEEP when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(28, 28, 'Synchronize', 'Passes on a burnCOMMApoisonCOMMAor paralysis to the foe.', 'When this Pok&eacute;mon becomes POISONCOMMAPARALYZECOMMAor BURNCOMMAso does the opponent. HoweverCOMMAFire-type and Water Veil ability Pok&eacute;mon cannot be BURNedCOMMAPoison-type and Steel-type and Immunity ability Pok&eacute;mon cannot be POISONedCOMMAand Limber ability Pok&eacute;mon cannot be PARALYZEd.'),
(29, 29, 'Clear Body', 'Prevents the Pok&eacute;mon&#x2019;s stats from being lowered.', 'Opponents&#x2019; moves which lower this Pok&eacute;mon&#x2019;s ability values have no effect. However this Pok&eacute;mon may lower its own stats with its own moves.'),
(30, 30, 'Natural Cure', 'All status problems are healed upon switching out.', 'The Pok&eacute;mon&#x2019;s status (BURNCOMMAPARALYZECOMMASLEEPCOMMAPOISONCOMMAFREEZE) is healed when withdrawn from battle.'),
(31, 31, 'Lightningrod', 'The Pok&eacute;mon draws in all Electric-type moves.', 'Electric-type moves are drawn to this Pok&eacute;mon.'),
(32, 32, 'Serene Grace', 'Boosts the likelihood of added effects appearing.', 'The chances of a move having an effect doubles.'),
(33, 33, 'Swift Swim', 'Boosts the Pok&eacute;mon&#x2019;s Speed in rain.', 'When rainyCOMMAThe Pok&eacute;mon&#x2019;s Speed doubles. HoweverCOMMASpeed will not double on the turn weather becomes Heavy Rain.'),
(34, 34, 'Chlorophyll', 'Boosts the Pok&eacute;mon&#x2019;s Speed in sunshine.', 'When sunnyCOMMAthe Pok&eacute;mon&#x2019;s Speed doubles. HoweverCOMMASpeed will not double on the turn weather becomes Clear Skies.'),
(35, 35, 'Illuminate', 'Raises the likelihood of meeting wild Pok&eacute;mon.', ''),
(36, 36, 'Trace', 'The Pok&eacute;mon copies the foe&#x2019;s ability.', 'Special ability becomes the same as that of the opponent. Switching this Pok&eacute;mon out of battle restores its original ability. In a Double BattleCOMMAa random opponent&#x2019;s ability will be copied.'),
(37, 37, 'Huge Power', 'Raises the Pok&eacute;mon&#x2019;s Attack stat.', 'The power of the Pok&eacute;mon&#x2019;s attacks is doubled; the effect is halved if the ability is changed (Skill Swap).'),
(38, 38, 'Poison Point', 'Contact with the Pok&eacute;mon may poison the foe.', 'The opponent has a 30% chance of being induced with POISON when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(39, 39, 'Inner Focus', 'The Pok&eacute;mon is protected from flinching.', 'This Pok&eacute;mon will not flinch. Does not prevent flinching with Focus Punch.'),
(40, 40, 'Magma Armor', 'Prevents the Pok&eacute;mon from becoming frozen.', 'This Pok&eacute;mon cannot be FREEZE condition while having this ability.'),
(41, 41, 'Water Veil', 'Prevents the Pok&eacute;mon from getting a burn.', 'This Pok&eacute;mon cannot be BURN condition while having this ability.'),
(42, 42, 'Magnet Pull', 'Prevents Steel-type Pok&eacute;mon from escaping.', 'Traps STEEL-type Pok&eacute;mon.'),
(43, 43, 'Soundproof', 'Gives full immunity to all sound-based moves.', 'Unaffected by sound moves. If this Pok&eacute;mon switches out with Baton PassCOMMAPerish Song against the switched out will not be nullified.'),
(44, 44, 'Rain Dish', 'The Pok&eacute;mon gradually recovers HP in rain.', 'If Heavy Rain weather is in effectCOMMArecovers 1/16th max Hit Points at the end of the turn.'),
(45, 45, 'Sand Stream', 'The Pok&eacute;mon summons a sandstorm in battle.', 'Sandstorm blows when the Pok&eacute;mon enters battle.'),
(46, 46, 'Pressure', 'The Pok&eacute;mon raises the foe&#x2019;s PP usage.', 'When this Pok&eacute;mon is hit by a moveCOMMAthe opponent&#x2019;s PP lowers by 2 rather than 1.'),
(47, 47, 'Thick Fat', 'Raises resistance to Fire-and Ice-type moves.', 'Fire and Ice-type moves deal 50% damage.'),
(48, 48, 'Early Bird', 'The Pok&eacute;mon awakens quickly from sleep.', 'SLEEP conditions lasts for half as longCOMMArounding down. For exampleCOMMAhalf of three turns is 1.5COMMAwhich rounds down to one turn. When the number of turns to sleep is oneCOMMAhalf of this rounded down is zeroCOMMAand the Pok&eacute;mon wakes up instantly.'),
(49, 49, 'Flame Body', 'Contact with the Pok&eacute;mon may burn the foe.', 'The opponent has a 30% chance of being induced with BURN when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(50, 50, 'Run Away', 'Enables sure getaway from wild Pok&eacute;mon.', 'Except for trainer battlesCOMMAcan always run from battle. Cannot run during Mean Look or Block or when the opponent is trapping with the Arena TrapCOMMAMagnet PullCOMMAor Shadow Tag ability.'),
(51, 51, 'Keen Eye', 'Prevents the Pok&eacute;mon from losing accuracy.', 'Opponent cannot lower this Pok&eacute;mon&#x2019;s accuracy.'),
(52, 52, 'Hyper Cutter', 'Prevents the Attack stat from being lowered.', 'Opponent cannot lower this Pok&eacute;mon&#x2019;s Attack value. This Pok&eacute;mon may still lower its own Attack value using a move of by itself.'),
(53, 53, 'Pickup', 'The Pok&eacute;mon may pick up items.', 'Has a 10% chance of finding and holding an item after battle. Will not work if this Pok&eacute;mon is already holding an item.'),
(54, 54, 'Truant', 'The Pok&eacute;mon can&#x2019;t attack on consecutive turns.', 'This Pok&eacute;mon cannot attack consecutively while having this ability.'),
(55, 55, 'Hustle', 'Boosts the Attack statCOMMAbut lowers accuracy.', 'Damage from physical attacks is 1.5 timesCOMMAbut average accuracy is only 80%.'),
(56, 56, 'Cute Charm', 'Contact with the Pok&eacute;mon may cause infatuation.', 'The opponent has a 30% chance of being induced with ATTRACT when using an attackCOMMAthat requires physical contactCOMMAagainst this Pok&eacute;mon.'),
(57, 57, 'Plus', 'Boosts Sp. Atk if another Pok&eacute;mon has Minus.', 'When battling with MinusCOMMASpecial Attack becomes 1.5 times greater.'),
(58, 58, 'Minus', 'Boosts Sp. Atk if another Pok&eacute;mon has Plus.', 'When battling with PlusCOMMASpecial Attack becomes 1.5 times greater.'),
(59, 59, 'Forecast', 'CASTFORM transforms with the weather.', 'This Pok&eacute;mon&#x2019;s type and figure change with the weather.'),
(60, 60, 'Sticky Hold', 'Protects the Pok&eacute;mon from item theft.', 'This Pok&eacute;mon&#x2019;s item cannot be taken.'),
(61, 61, 'Shed Skin', 'The Pok&eacute;mon may heal its own status problems.', 'Every turnCOMMAit has a 1 in 3 chance of healing from a status condition (BURNCOMMAPARALYZECOMMASLEEPCOMMAPOISONCOMMAFREEZE).'),
(62, 62, 'Guts', 'Boosts Attack if there is a status problem.', 'Attack raises to 1.5 times when induced with a status (BURNCOMMAPARALYZECOMMASLEEPCOMMAPOISONCOMMAFREEZE). BURN&#x2019;s effect of lowering Attack is still applied.'),
(63, 63, 'Marvel Scale', 'Boosts Defense if there is a status problem.', 'Ups DEFENSE if suffering.'),
(64, 64, 'Liquid Ooze', 'Inflicts damage on foes using any draining move.', 'When the opponent absorbs Hit Points from this Pok&eacute;monCOMMAthe opponent instead loses Hit Points.'),
(65, 65, 'Overgrow', 'Powers up Grass-type moves in a pinch.', 'When HP is below 1/3rdCOMMAGrass&#x2019;s power increases to 1.5 times.'),
(66, 66, 'Blaze', 'Powers up Fire-type moves in a pinch.', 'When HP is below 1/3rdCOMMAFire&#x2019;s power increases to 1.5 times.'),
(67, 67, 'Torrent', 'Powers up Water-type moves in a pinch.', 'When HP is below 1/3rdCOMMAWater&#x2019;s power increases to 1.5 times.'),
(68, 68, 'Swarm', 'Powers up Bug-type moves in a pinch.', 'When HP is below 1/3rdCOMMABug&#x2019;s power increases to 1.5 times.'),
(69, 69, 'Rock Head', 'Protects the Pok&eacute;mon from recoil damage.', 'Does not receive recoil damage from recoil-causing damages.'),
(70, 70, 'Drought', 'The Pok&eacute;mon makes it sunny if it is in battle.', 'Weather changes to Clear Skies when the Pok&eacute;mon enters the battle.'),
(71, 71, 'Arena Trap', 'Prevents the foe from fleeing.', 'The opponent cannot run nor switch. Flying-type Pok&eacute;mon and Pok&eacute;mon with the Levitate special ability are unaffected. If this Pok&eacute;mon switchesCOMMAthe opponent is still trapped for that turn. The opponent may still switch by using Baton Pass.'),
(72, 72, 'Vital Spirit', 'Prevents the Pok&eacute;mon from falling asleep.', 'The Pok&eacute;mon cannot be SLEEP condition while having this ability.'),
(73, 73, 'White Smoke', 'Prevents the Pok&eacute;mon&#x2019;s stats from being lowered.', 'Opponents&#x2019; moves which lower this Pok&eacute;mon&#x2019;s ability values have no effect. However this Pok&eacute;mon may lower its own stats with its own moves.'),
(74, 74, 'Pure Power', 'Boosts the power of physical attacks.', 'The Pok&eacute;mon&#x2019;s attack power is doubled in battle while having this ability.'),
(75, 75, 'Shell Armor', 'The Pok&eacute;mon is protected against critical hits.', 'Opponent&#x2019;s moves cannot Critical Hit.'),
(76, 76, 'Air Lock', 'Eliminates the effects of weather.', 'All weather effects are negated while the Pok&eacute;mon is on the field.'),
(77, 77, 'Tangled Feet', 'Raises evasion if the Pok&eacute;mon is confused.', 'Pok&eacute;mon&#x2019;s evasion raises one level when Confused.'),
(78, 78, 'Motor Drive', 'Raises Speed if hit by an Electric-type move.', 'The Pok&eacute;mon takes no damage from Electric-type attacks and Speed raises by one level.'),
(79, 79, 'Rivalry', 'Raises Attack if the foe is of the same gender.', 'Attack is increased if the foe is of the same gender; Attack is decreased if the foe is of the opposite gender.'),
(80, 80, 'Steadfast', 'Raises Speed each time the Pok&eacute;mon flinches.', 'Speed raises by one level every time the Pok&eacute;mon flinches.'),
(81, 81, 'Snow Cloak', 'Raises evasion in a hailstorm.', 'Raises the Pok&eacute;mon&#x2019;s evasion during a hailstorm by one level.'),
(82, 82, 'Gluttony', 'Encourages the early use of a held Berry.', 'A held Berry is eaten earlier than usual when HP is low.'),
(83, 83, 'Anger Point', 'Raises Attack upon taking a critical hit.', 'Increases Attack to maximum level upon taking a critical hit.'),
(84, 84, 'Unburden', 'Raises Speed if a held item is used.', 'Speed is doubled once the held item is consumed.'),
(85, 85, 'Heatproof', 'Weakens the power of Fire-type moves.', 'Damage from Fire-type moves and BURN is halved.'),
(86, 86, 'Simple', 'The Pok&eacute;mon is prone to wild stat changes.', 'The effectiveness of all stat modifications is doubled.'),
(87, 87, 'Dry Skin', 'Reduces HP if it is hot. Water restores HP.', 'HP is restored when hit by Water-type moves or when it is raining but also makes the Pok&eacute;mon weak to Fire-type moves and reduces HP during strong sunlight.'),
(88, 88, 'Download', 'Adjusts power according to the foe&#x2019;s ability.', 'Attack is increased when the foe&#x2019;s Defense is lower than its Special Defense or increases Special Attack when the foe&#x2019;s Special Defense is lower than its Defense.'),
(89, 89, 'Iron Fist', 'Boosts the power of punching moves.', 'The power of punching moves is increased by 20%.'),
(90, 90, 'Poison Heal', 'Restores HP if the Pok&eacute;mon is poisoned.', 'HP is restored every turn while the Pok&eacute;mon has POISON condition.'),
(91, 91, 'Adaptability', 'Powers up moves of the same type.', 'Doubles the power of same type moves.'),
(92, 92, 'Skill Link', 'Increases the frequency of multi-strike moves.', 'Moves that attack 2-5 times always hit 5 times.'),
(93, 93, 'Hydration', 'Heals status problems if it is raining.', 'All status problems are healed when raining.'),
(94, 94, 'Solar Power', 'Boosts Sp. AtkCOMMAbut lowers HP in sunshine.', 'Pok&eacute;mon&#x2019;s Special Attack raises to 1.5 times but HP decreases every turn.'),
(95, 95, 'Quick Feet', 'Boosts Speed if there is a status problem.', 'Speed is doubled when induced with a status (BURNCOMMASLEEPCOMMAPOISONCOMMAFREEZE but not PARALYZE).'),
(96, 96, 'Normalize', 'All the Pok&eacute;mon&#x2019;s moves become the Normal type.', 'All moves known by the Pok&eacute;mon turn into Normal-type.'),
(97, 97, 'Sniper', 'Powers up moves if they become critical hits.', 'Power of critical-hit moves is tripled instead of doubled.'),
(98, 98, 'Magic Guard', 'The Pok&eacute;mon only takes damage from attacks.', 'Prevents all damage except from dirrect-attack moves.'),
(99, 99, 'No Guard', 'Ensures the Pok&eacute;mon and its foe&#x2019;s attacks land.', 'The accuracy of all moves known by all Pok&eacute;mon on the field raises to 100%'),
(100, 100, 'Stall', 'The Pok&eacute;mon moves after even slower foes.', 'The Pok&eacute;mon always attacks last.'),
(101, 101, 'Technician', 'Powers up the Pok&eacute;mon&#x2019;s weaker moves.', 'Moves with a base power of 60 or less raise to 1.5 times.'),
(102, 102, 'Leaf Guard', 'Prevents status problems in sunny weather.', 'All status problems are healed during strong sunlight.'),
(103, 103, 'Klutz', 'The Pok&eacute;mon can&#x2019;t use any held items.', 'The Pok&eacute;mon cannot hold any items except those that affect experience such as Exp.Share or Macho Brace.'),
(104, 104, 'Mold Breaker', 'Moves can be used regardless of abilities.', 'The Pok&eacute;mon is not affected by foe&#x2019;s abilities during battle'),
(105, 105, 'Super Luck', 'Heightens the critical-hit ratios of moves.', 'Raises the critical-hit ratio of moves; allows simultaneous use of Dire Hit and Focus Energy.'),
(106, 106, 'Aftermath', 'Damages the foe landing the finishing hit.', 'The foe that dealt the final hit loses 1/4 of its maximum HP.'),
(107, 107, 'Anticipation', 'Senses the foe&#x2019;s dangerous moves.', 'Warns when the foe knows 1-hit KO or super-effective moves.'),
(108, 108, 'Forewarn', 'Determines what moves the foe has.', 'Reveals the foe&#x2019;s strongest move.'),
(109, 109, 'Unaware', 'Ignores any change in ability by the foe.', 'Foe&#x2019;s stat modifications are ignored.'),
(110, 110, 'Tinted Lens', 'Powers up &#x201C;not very effective&#x201D; moves.', 'The power of &#x201C;not very effective&#x201D; moves is doubled.'),
(111, 111, 'Filter', 'Powers down super-effective moves.', 'Damage by super-effective moves is halved.'),
(112, 112, 'Slow Start', 'Temporarily halves Attack and Speed.', 'Attack and Speed is halved during the first five turns in a battle.'),
(113, 113, 'Scrappy', 'Enables moves to hit Ghost-type foes.', 'A Ghost-type foe can be hit by Normal-type attacks.'),
(114, 114, 'Storm Drain', 'The Pok&eacute;mon draws in all Water-type moves.', 'Water-type moves are drawn to this Pok&eacute;mon.'),
(115, 115, 'Ice Body', 'The Pok&eacute;mon regains HP in a hailstorm.', 'HP is restored when it&#x2019;s hailing.'),
(116, 116, 'Solid Rock', 'Powers down super-effective moves.', 'Damage by super-effective moves is halved.'),
(117, 117, 'Snow Warning', 'The Pok&eacute;mon summons a hailstorm in battle.', 'Hailstorm blows when the Pok&eacute;mon enters battle.'),
(118, 118, 'Honey Gather', 'The Pok&eacute;mon may gather Honey from somewhere.', 'May pick up a Honey after battle; the higher the levelCOMMAthe higher the chance.'),
(119, 119, 'Frisk', 'The Pok&eacute;mon can check the foe&#x2019;s held item.', 'Reveals the foe&#x2019;s held item.'),
(120, 120, 'Reckless', 'Powers up moves that have recoil damage.', 'The power of moves that have recoil damage is doubledCOMMAbut so is the recoil.'),
(121, 121, 'Multitype', 'Changes type to match the held Plate.', ''),
(122, 122, 'Flower Gift', 'Powers up party Pok&eacute;mon when it is sunny.', 'Ally&#x2019;s Attack and Special Attack are multiplied by 1.5 during strong sunlight.'),
(123, 123, 'Bad Dreams', 'Reduces a sleeping foe&#x2019;s HP.', '');