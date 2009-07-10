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

function getFloorExpFromLevel($level, $algorithm) {
	if($level > 100) $level = 100; 
	if($level < 2) return 0;
	
	switch($algorithm) {
	
		case 0: // Erratic algorithm
			if(($level > 0) && ($level <= 50)) {
				$exp = ((100 - $level) / 50) * pow($level, 3);
			}
			elseif(($level > 50) && ($level <= 68)) {
				$exp = ((150 - $level) / 100) * pow($level, 3);
			}
			elseif(($level > 68) && ($level <= 98)) {
				$x = $level % 3;
				if($x == 0) $p = 0;
				if($x == 1) $p = 0.008;
				if($x == 2) $p = 0.014;
				$exp = (($level / 3) - $p) / 50;
				$exp = 1.274 - $exp;
				$exp = $exp * pow($level, 3);
				// Third function still has issues
				$exp = pow($level, 3) * (1.274 - (1 / 50) * ($level / 3) - $p);
			}
			elseif(($level > 98) && ($level <= 100)) {
				$exp = ((160 - $level) / 100) * pow($level, 3);
			}
			break;

		case 1: // Fast algorithm
			$exp = (4 * pow($level, 3)) / 5;
			break;
			
		case 2: // Medium-fast algorithm
			$exp = pow($level, 3);
			break;
			
		case 3: // Medium-slow algorithm
			$exp = ((6 * pow($level, 3)) / 5) - (15 * pow($level, 2)) + (100 * $level) - 140;
			break;
			
		case 4: // Slow algorithm
			$exp = (5 * pow($level, 3)) / 4;
			break;
			
		case 5: // Fluctuating algorithm
			if(($level > 0) && ($level <= 15)) {
				// First fluctuation
				$exp = ($level + 1) / 3;
				$exp = ($exp + 24) / 50;
				$exp = $exp * pow($level, 3);
			} elseif(($level > 15) && ($level <= 35)) {
				// Second fluctuation
				$exp = ($level + 14) / 50;
				$exp = $exp * pow($level, 3);
			} elseif(($level > 25) && ($level <= 100)) {
				// Third fluctuation
				$exp = 32 + ($level / 2);
				$exp = $exp / 50;
				$exp = $exp * pow($level, 3);
			}
			break;
		}
		return floor($exp);
}

function getCeilingExpFromLevel($level, $algorithm) {
	return getFloorExpFromLevel($level + 1, $algorithm) - 1;
}

function getLevelFromExp($exp, $algorithm) {

		switch($algorithm) {
		
			case 0:
				for($level = 1; $level < 100; $level++) {
					if(getCeilingExpFromLevel($level, $algorithm) > $exp) break;
				}
				break;
				
			case 1: // Fast algorithm
				$level = (5 * $exp) / 4;
				$level = pow($level, (1 / 3));
				break;
			
			case 2:	// Medium-fast algorithm
				$level = pow($exp, (1 / 3));
				break;
				
			case 3:
				for($level = 1; $level < 100; $level++) {
					if(getCeilingExpFromLevel($level, $algorithm) > $exp) break;
				}
				// Using the polynomial
				// $level = solvePolynomial(1.2, -15, 100, -140, $exp);
				break;
				
			case 4: // Slow
				$level = $exp * 0.8;
				$level = pow($level, (1 / 3));
				break;
			
			case 5:
				for($level = 1; $level < 100; $level++) {
					if(getCeilingExpFromLevel($level, $algorithm) > $exp) break;
				}
				break;
				
		}
		
		if($level < 1) $level = 1;
		return round($level);
		
}

function solvePolynomial($a, $b, $c, $d, $y = 0) {
	$d = $d - $y; // Move the Y across to the other side
	$p = -$b / (3 * $a); // Calculate P
	$q = pow($p, 3) + ((($b * $c) - (3 * $a * $d)) / (6 * pow($a, 2))); // Calculate Q
	$r = $c / (3 * $a);
	$s = pow($q + pow(pow($q, 2) + ($r - pow($p, 2)), 0.5), (1/3));
	$t = $q - pow(pow($q, 2) + ($r - pow($p, 2)), 0.5);
	if($t < 0) {
		$t = -$t;
		$t = pow($t, (1/3));
		$t = -$t;
	} else {
		$t = pow($t, (1/3));
	}
	return floor($s + $t + $p);
}

?>