<?php

class Score {
  public $name;
	public $solution;
	public $duration;
	public $tries;
  
  public function __construct($serializedHangman) {
    $serializedHangman = str_replace("\n", '', $serializedHangman);
    $hangmanData = explode(':', $serializedHangman);
    $this->name = $hangmanData[0];
    $this->solution = $hangmanData[1];
    $this->duration = $hangmanData[2];
    $this->tries = $hangmanData[3];
  }
  
  public function isBetterThan(Score $score) {
     return $this->duration < $score->duration;
  }
  
  public function toString() {
    return "Name: ".$this->name." Solution: ".$this->solution." Duration: ".$this->duration." Tries: ".$this->tries;
  }
  
  public function serialice() {
		return $this->name.':'.$this->solution.':'.$this->duration.':'.$this->tries;
	}
  
}