<?php
    // This class represents a level in the letters and numbers game.
    // It renders the level interface, handles the game logic, and provides feedback to the player.

    require '../../db/Database.php';
    require '../../Player.php';
    require '../../src/game/LettersGameLevel.php';
    require 'header.php';
    require_once '../../src/features/Session.php';

    class Level {
        private $word;
        private $headerMessage;
        private $guidanceMessage;
        public function __construct($word, $headerMessage=null, $guidanceMessage=null) {
            $this->word = $word;
            $this->headerMessage = $headerMessage;
            $this->guidanceMessage = $guidanceMessage;
        }

        // Method to render the level interface and handle game logic.
        public function render() {
            SessionUtility::startSession();
            $player = SessionUtility::getPlayerObject();
            $header = new Header();
            $header->render();
            ?>
            <div class="answerContainer">
                <h2 style="display: inline;">Level <?php echo $_SESSION['level'] ?></h2> 
                <h2 style="display: inline; margin-left: 77%;">
                    <label for="lives">Lives: </label>
                    <span id="lives"><?php echo $_SESSION['lives'] ?> </span><br><br>
                </h2>
                <h2><?php echo $this->headerMessage ?> </h2>
                <p><?php echo $this->guidanceMessage ?></p>
                <?php
                try {
                    $this->renderAndHandleGame();
                }
                catch (Exception $e) {
                    die(urldecode($e->getMessage()));
                }
                ?>
                
                <h2>
                    <span>Result: </span>
                    <span id="correctAnswer"></span>
                </h2>
                <br><br>
                <form method="post" action="../../src/game/Game.php">
                    <button type="submit" id="nextLevel" name="submitLevel" value="SEND" disabled>Next</button>
                    <br><br>
                    <button type="submit" id="restartButton" name="restartButton" value="SEND" style="display: none; ">Try Again!</button>
                    <button type="submit" id="finishButton" name="finishButton" value="SEND" style="display: none; ">Finish!</button>
                    <br><br>
                    <button type="submit" id="cancelButton" name="cancelButton" value="SEND">Cancel</button>
                    <button type="submit" id="homeButton" name="homeButton" value="SEND" style="display: none; ">Home Page</button>
                <br><br>     
                </form>
            </div>
            <?php
            require 'footer.html';
        }

        // Method to render and handle the game logic for the current level.
        private function renderAndHandleGame() {
            // Create instance of LettersGameLevel with the current word.
            $lettersGameLevel = new LettersGameLevel($this->word);
            // Set up the level and display it.
            $lettersGameLevel->setupLevel();
            $lettersGameLevel->displayLevel();
        }

    }

?>

