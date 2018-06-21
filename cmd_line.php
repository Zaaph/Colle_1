<?php

	function query ($tab, $results, $x){
		if ($results[1] === "query") {
			if ($tab[((4*$results[2]) + 2) + 
				((($results[3]*2)+1)*((4*$x + 2)))] === "X") {
				echo "full\n";
			}
			else {
				echo "empty\n";
			}
		}
	}

	function add(&$tab, $results, $x) {
		if ($results[1] === "add") {
			if ($tab[((4*$results[2]) + 2) + 
				((($results[3]*2)+1)*((4*$x + 2)))] === "X") {
				echo "A cross already exists at this location\n";
			}
			else {
				$tab[((4*$results[2]) + 2) + 
				((($results[3]*2)+1)*((4*$x + 2)))] = "X";
			}
		}
	}

	function remove(&$tab, $results, $x) {
		if ($results[1] === "remove") {
			if ($tab[((4*$results[2]) + 2) + 
				((($results[3]*2)+1)*((4*$x + 2)))] === "X") {
				$tab[((4*$results[2]) + 2) + 
				((($results[3]*2)+1)*((4*$x + 2)))] = " ";
			}
			else {
				echo "No cross exists at this location\n";
			}
		}
	}

	function help($cmd) {
		if ($cmd === "help") {
			echo "\t\t\t\tWelcome to battleships!\n\t\tCommands :\n
	'query[X,Y]' : Checks if a cross exists at location [X,Y]
	(displays 'full' or 'empty')\n
 	'add [X,Y]' : add a cross at the coordinates [X,Y]\n
	'remove [X,Y]' : remove a cross from the coordinates[X,Y]\n
	'display' : displays the grid with modifications\n
	'quit' : quit battleships :c\n";
		}
	}

	function cmd_line(&$str, $x) {
		$tab = str_split($str);
		$results = array();
		$cmd = readline("$> ");
		help($cmd);
		if ($cmd === "display") {
			echo $str;
		}
		if ($cmd === "quit") {
			die();
		}
		$regex = "/(.+) \[([0-9]), ([0-9])\]/";
		preg_match($regex, $cmd, $results);
		if ($results) {
			query($tab, $results, $x);
			add($tab, $results, $x);
			remove($tab, $results, $x);
		}
		$str = implode(NULL, $tab);
		cmd_line($str, $x);
	}

?>