<?php


class Highscores {
  
  private $highscores;
  
  public function __construct() {
    $file = fopen('highscores.txt', 'r');
    $this->highscores = array();
		$counter = 0;
		while($line = fgets($file))
		{
			$this->highscores[$counter] = new Score($line);
			$counter++;
		} // while
  }
	
	public function saveScore(Score $score) {
		$this->addScore($score);
    $this->printHighscores();
    $this->updateFile();
	}
	
	public function addScore(Score $score) {
    $enteredTheList = false;
   
		for ($i = 0; $i < count($this->highscores) && $i < 10 && !$enteredTheList; $i++) {
      $highscore = $this->highscores[$i];
			if ($score->isBetterThan($this->highscores[$i])) {
        $tempArray = array(); //Needed so that splice can be used
        $tempArray[0] = $score;
			  array_splice($this->highscores, $i, 0, $tempArray);
        $enteredTheList = true;
			}
		}
		while (count($this->highscores) > 10) {
			array_pop($this->highscores);
		}
    if (count($this->highscores) < 10 && !$enteredTheList) {
      echo "ffff";
      array_push($this->highscores, $score);
      $enteredTheList = true;
    }
	}
	
	public function printHighscores() {
		for ($i = 0; $i < count($this->highscores); $i++) {
			echo $this->highscores[$i]->toString();
      echo "<br />";
		}
	}
  
  public function updateFile() {
    $file = fopen('highscores.txt', 'a+');
    file_put_contents("highscores.txt", "");
    echo "Updating file".count($this->highscores);
    for ($i = 0; $i < count($this->highscores); $i++) {
			fwrite($file, $this->highscores[$i]->serialice()."\n");
		}
    fclose($file);
  }
  
  public function getHighscores() {
    $highscores = array();
    for ($i = 0; $i < count($this->highscores); $i++) {
      $highscores[$i] = $this->highscores[$i]->serialice();
    }
    return $highscores;
  }
}