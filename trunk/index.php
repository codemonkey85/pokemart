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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>The Pokemart: PKM Reader</title>
</head>

<body bgcolor="#FF8000">

<table align="center" cellspacing="0" cellpadding="0" style="width: 770px;">
	<tr>
		<td style="background: url('images/pages/pkmreader_1a.jpg'); width: 174px; height: 197px;"></td>
		<td style="background: url('images/pages/pkmreader_1b.jpg'); width: 426px; height: 197px;"></td>
		<td style="background: url('images/pages/pkmreader_1c.jpg'); width: 170px; height: 197px;"></td>
	</tr>
	<tr>
		<td style="background: url('images/pages/pkmreader_2a.jpg'); width: 174px; height: 53px;"></td>
		<td style="background: url('images/pages/pkmreader_2b.jpg'); width: 426px; height: 53px;">
			<form action="pkm.php" method="post" enctype="multipart/form-data" style="margin-left: 20px; margin-bottom: 0px;">
				<input type="hidden" name="MAX_FILE_SIZE" value="1024" />
				<input name="pkmfile" type="file" /><br />
				Or enter an URL: <input name="pkmurl" /><input type="submit" value="Go!" style="margin-left: 10px;"/>
			</form>
		</td>
		<td style="background: url('images/pages/pkmreader_2c.jpg'); width: 170px; height: 53px;"></td>
	</tr>
	<tr>
		<td style="background: url('images/pages/pkmreader_3a.jpg'); width: 174px; height: 57px;"></td>
		<td style="background: url('images/pages/pkmreader_3b.jpg'); width: 426px; height: 57px;"></td>
		<td style="background: url('images/pages/pkmreader_3c.jpg'); width: 170px; height: 57px;"></td>
	</tr>
</table>

<table align="center" cellpadding="0" cellspacing="0" style="width: 800px;">
	<tr>
		<td style="background: url('images/pages/textbox_top.jpg'); height: 20px; width: 800px;"></td>
	</tr>
	<tr>
		<td style="background: url('images/pages/textbox_middle.jpg');">
			<div style="padding-left: 50px; padding-top: 5px; padding-right: 50px; font-family: Tahoma, Verdana, Arial, Helvetica; font-size: 12px;">
				<h2>Change Log</h2>
				<strong>Sun 15 Feb</strong><br />
				Koren language support has been implemented. The Poke Ball field now shows
				the name of the ball rather than the number. All Pokedex's have been entered
				now, show it will show Kanto, Johto, Hoenn and Sinnoh numbers as well as
				the National numbers. Added the Current Level, the Met At Level, the
				Country Of Origin (Language) and the Growth Rate.
				<br /><br />
				Also added an extra line to the Stats table, which attempts to calculate
				the in-game stats derived from the Base Stats, IVs, EVs, Level and Nature of
				the Pokemon. It's not perfect, but it gives you a pretty accurate idea.
				<br /><br />
				Other than that, some minor bug fixes to the Moves table and the Ribbons
				table. Fixed the problem that was causing some PIDs to be reported as
				negative numbers. Put basic error checking in there to stop if from 
				processing non-PKM files.
				<br /><br />
				<strong>Sat 14 Feb</strong><br />
				Pokemon Types are now appearing underneath the Pokemon. Added support for
				Ribbons, although I'm missing images for some of them. Home Town is now
				working properly and giving proper names. Have added Power and Accuracy to
				the Moves table.
				<br /><br />
				<strong>Fri 13 Feb</strong><br />
				Proper character support is here! I'd say 99.9% of characters have now been 
				mapped properly, so you can view Pokemon with Japanese nicknames and trainer
				names. Have added support for PID, Nature and Friendship. Area Met and Held
				Item are now shown as text instead of numbers. Also fixed a problem that was
				causing incorrect reporting of Gender and Fateful Encounter.
				<br /><br />
				<strong>Wed 11 Feb</strong><br />
				Corrected problem generated when a Pokemon has learned less than four moves.
				Added the ability to retrieve a PKM file from an URL, rather than having
				to upload it.
				
				<h2>Still To Do</h2>
				<strong>Eggs</strong><br />
				Need some more work on the different Platinum values and then I can put all the
				Egg and hatching information up as well.
				<br /><br />
				<strong>Pokerus</strong><br />
				Need some more information on how this works - the possible values and what
				they mean. <a href="mailto:andy@thepokemart.com">E-mail me</a> if you have info.
				<br /><br />
				<strong>Contests</strong><br />
				Contest Stats have not been implemented yet, but Contest Ribbons will show
				up under Ribbons.
				<br /><br />
				<strong>Other Things Not Implemented</strong><br />
				No support for the following:
				<ul>
					<li>Alternate Forms</li>
					<li>Encounter Type</li>
					<li>Markings</li>
				</ul>
				<br /><br />
			</div>
		</td>
	</tr>
	<tr>
		<td style="background: url('images/pages/textbox_bottom.jpg'); height: 25px; width: 800px;"></td>
	</tr>
</table>
	
</body>
</html>