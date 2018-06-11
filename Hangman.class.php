<?php
require __DIR__ . '/highscores.php';
require __DIR__ . '/score.php';

class Hangman {
	private $playerName;
	private $originalSolution;
	private $solution;
	private $progress;
	private $maskedProgress;
	private $tries;
	private $failedLetters;
	private $startTime;
	
	function __construct($playerName) {
    $solution = $this->getSolution();
		$this->originalSolution = $solution;
		$this->solution = $solution;
		$this->progress = preg_replace("/(.)/", "*", $this->solution);
		$this->tries = 7;
		$this->failedLetters = array();
		$this->playerName = $playerName;
		$this->startTime = time();
	}
	
	public function playLetter($guessLetter) {
		$triesAndProgress = array();
		if ($this->tries > 1) {
			$triesAndProgress[1] = $this->makeGuess($guessLetter);
			$triesAndProgress[0] = $this->tries;
		} else {
      return $triesAndProgress[0]."-".$this->originalSolution;
    }
		
		return $triesAndProgress[0]."-".$triesAndProgress[1];
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
		
		if($this->solution === preg_replace("/(.)/", "*", $this->originalSolution)) {
			$highscores = new Highscores();
      $score = new Score($this->serialice(time() - $this->startTime));
			$highscores->saveScore($score);
		}
		
		return $this->progress;
	}
	
	public function serialice($duration) {
		return $this->playerName.':'.$this->originalSolution.':'.$duration.':'.$this->tries;
	}
  
  public function testFunction() {
    return time()."asdf";
  }
  
 public function servidorEstampillaDeTiempo() {
		return time()."asdfasdf";
	}
	
  public function startGame($name) {
    $this->originalSolution = $this->getSolution();
		$this->solution = $this->originalSolution;
		$this->progress = preg_replace("/(.)/", "*", $this->solution);
		$this->tries = 7;
		$this->failedLetters = array();
		$this->playerName = $name;
		$this->startTime = time();
    return $this->progress;
  }
  
  public function listHighscores() {
    $highscores = new Highscores();
    return $highscores->getHighscores();
  }
  
  public function getSolution() {
    $fileContents = file("fruits.txt");
    $line = $fileContents[array_rand($fileContents)];
    $data = $line;
    
    return $data;
  }
  
  public function setSolution($solution) {
    $this->originalSolution = $solution;
    $this->solution = $solution;
  }
  
}

