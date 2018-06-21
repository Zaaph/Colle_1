<?php
	
	include 'cmd_line.php';

	function colle_helper($char1, $char2, &$i, $x, $y, &$str) {
		$count = 0;
		while ($i < $x) {
			$str .= $char1;
			while ($count < 3) {
				$str .= $char2;
				$count++;
			}
			$count = 0;
			$i++;
		}
	}

	function put_crosses($coords, $x, $y, &$str) {
		if ($coords !== NULL) {
			$tab = str_split($str);
			foreach ($coords as $value) {
				if ($value[0] > $x - 1 || $value[1] > $y - 1 
					|| $value[0] < 0 || $value[1] < 0)
					continue;
				$tab[((4*$value[0]) + 2) + 
					((($value[1]*2)+1)*((4*$x + 2)))] = "X";
			}
		}
		$str = implode(NULL, $tab);
	}

	function colle($x, $y, $coords=NULL) {
		$i = 0;
		$j = 0;
		$str = "";

		if ($y === 0)
			return;
		while ($j <= $y*2) {
			colle_helper("+", "-", $i, $x, $y, $str);
			$str .= "+\n";
			$i = 0;
			$j++;
			if ($j === $y*2 + 1)
				break;
			colle_helper("|", " ", $i, $x, $y, $str);
			$str .= "|";
			$i = 0;
			$str .= "\n";
			$j++;
		}
		put_crosses($coords, $x, $y, $str);
		echo $str;
		cmd_line($str, $x);
	}
	colle(4, 4, [[1,1], [3,3], [2,1]]);

?>