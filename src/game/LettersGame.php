<?php
/* This abstract class defines the structure for a letters/numbers based game. */

abstract class LettersGame {
    public function __construct() {

    }


    abstract protected function shuffleWord();
    abstract protected function createAndManageInput();

    abstract public function setupLevel();

    abstract public function displayLevel();


}