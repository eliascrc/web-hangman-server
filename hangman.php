<?php
class Hangman {
	private $solution;
	private $progress;
	private $maskedProgress;
	private $tries;
	
	function __construct() {
		$this->solution = "hangman";
		$this->progress = preg_replace("/(.)/", "*", $this->solution);
		$this->tries = 1000;
	}
	
	public function makeGuess($guessLetter) {
		$position = strpos($this->solution, $guessLetter);
		
		if ($this->tries > 1) {
			if ($position === false) {
				$this->tries--;
			}
		
			while($position !== false) {
				$this->progress[$position] = $this->solution[$position];
				$this->solution[$position] = "*";
				$position = strpos($this->solution, $guessLetter);
			}
			
			return $this->progress;
		} else {
			return false;
		}
		
	}
	
}

$hangman = new Hangman();
echo $hangman->makeGuess("a");
echo $hangman->makeGuess("h");