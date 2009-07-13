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

require_once('common.php'); // Load common functionality

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

</body>
</html>