<?php

class Highscores {
	
	public function saveScore($serializedHangman) {
		echo $serializedHangman;
		$file = fopen('highscores.txt', 'a+');
		
		/*
		if (fwrite($file, $serializedHangman."\n"))
		{
			fclose($file);
			return true;
		}
		else
		{
			fclose($file);
			return false;
		}
		*/
	}
	
	public function scoresToMatrix() {
		$file = fopen('highscores.txt', 'a+');
		$counter = 0;
		while($line = fgets($highscores))
		{
			$matrix[$counter] = explode(':', $line);
			$counter++;
		} // while
		
		return $matrix;
	}
	
	public function addScore($score, $scoresMatrix) {
		for ($i = 0; $i < count($scoresMatrix) && $i < 10; i++) {
			if ($i == 0 /* and compare the new score to the one that is stored */) {
				$scoresMatrix = $score + $scoresMatrix;
				$scoresMatrix->pop();
			}
		}
	}
}