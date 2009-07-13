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

/* DATABASE CONFIG: Change these to your database server settings */

$DB_User = 'root';
$DB_Password = 'password';
$DB_Host = 'localhost';
$DB_Schema = 'pokemon';

$dbconn = mysql_connect($DB_Host, $DB_User, $DB_Password);
mysql_select_db($DB_Schema);

/* Class autoloader function */

function __autoload($ClassName) {
	require_once('classes/'.$ClassName.',php');
}