<?php
class Hangman {
	private $playerName;
	private $originalSolution;
	private $solution;
	private $progress;
	private $maskedProgress;
	private $tries;
	private $failedLetters;
	private $startTime;
	
	function __construct($solution, $playerName) {
		$this->originalSolution = $solution;
		$this->solution = $solution;
		$this->progress = preg_replace("/(.)/", "*", $this->solution);
		$this->tries = 7;
		$this->failedLetters = array();
		$this->playerName = $playerName;
		$this->startTime = time();
	}
	
	public function play($guessLetter) {
		$triesAndProgress = array();
		if ($this->tries > 1) {
			$triesAndProgress[1] = $this->makeGuess($guessLetter);
			$triesAndProgress[0] = $this->tries;
		}
		
		return $triesAndProgress;
	}
	
	public function makeGuess($guessLetter) {
		$position = strpos($this->originalSolution, $guessLetter);
		
		if ($position === false && !in_array($guessLetter, $this->failedLetters)) {
			array_push($this->failedLetters, $guessLetter);
			$this->tries--;
		}
	
		while($position !== false) {
			$this->progress[$position] = $this->originalSolution[$position];
			$this->solution[$position] = "*";
			$position = strpos($this->solution, $guessLetter);
		}
		
		if(strpos($this->originalSolution, "*") === false) {
			$this->saveScore(time() - $startTime);
		}
		
		return $this->progress;
	}
	
	public function serialice($duration) {
		return $this->playerName.':'.$this->originalSolution.':'.$duration;
	}
	
	public function saveScore($duration) {
		$file = fopen('highscores.txt', 'a+');
		if (fwrite($file, $this->serialice($duration)."\n"))
		{
			fclose($file);
			return true;
		}
		else
		{
			fclose($file);
			return false;
		}
	}
}

$hangman = new Hangman("solution", "name");
echo $hangman->serialice(time());
