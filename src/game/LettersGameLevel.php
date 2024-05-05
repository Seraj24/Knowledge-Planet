<?php
/* This class represents a level of a letters/numbers based game, extending the abstract class LettersGame. */

require 'LettersGame.php';

class LettersGameLevel extends LettersGame {
    private $word; //Means string to split. Numbers or letters.
    private $lettersArray;
    private $shuffledWord; //array
    public function __construct($word) {
        parent::__construct();
        $this->word = $word;
    }

    // Method to create and manage player input during the game.
    protected function createAndManageInput() {
        $word_json = json_encode($this->word);    

        //Generate second input for level 5 and 6
        if ($_SESSION['level'] > 4) {
          //Default label and input for answer
          echo '<label for="answer">Lowest: </label>';
          echo '<input type="text" id="answer" name="answer">';  
          echo '<label for="highest">Highest: </label>';
          echo '<input type="text" id="highest" name="highest">';
        }
        else {
            //Default label and input for answer
            echo '<label for="answer">Your answer: </label>';
            echo '<input type="text" id="answer" name="answer">';
        }
      
        echo '<button type="button" id="checkButton">Check</button>';
        echo '<span id="word" style="display: none;">' . $this->word . '</span><br><br>';
        echo '<script src="../../public/assets/js/ajax_submit.js"></script>';
      }
    
    
    
    // Method to shuffle the word for the game.
    protected function shuffleWord() {
        $this->shuffledWord = array();
        $this->lettersArray = str_split($this->word);
        $usedIndex = array();
        foreach($this->lettersArray as $letter) {
            $randomIndex = rand(0, count($this->lettersArray) - 1);
            while (in_array($randomIndex, $usedIndex)) {
                $randomIndex = rand(0, count($this->lettersArray) - 1);
            }
            $usedIndex[] = $randomIndex;
            $this->shuffledWord[] = $this->lettersArray[$randomIndex]; 
        }
    }

    // Method to set up the game level.
    public function setupLevel() {
        $this->shuffleWord();

    }

    // Method to display the current game level.
    public function displayLevel() {
        if ($this->shuffledWord === null) {
            throw new Exception("Level has not been setup yet Or one or more element failed to setup!");
        } else {
            echo 'To Sort: <br>';
            $word = ""; //Reset the word, in order to pass the case sensetive version of it.
            $index = 0;
            foreach($this->shuffledWord as $letter) {
                $lower = strtolower($letter);
                $upper = strtoupper($letter);
                $tempArray = [$lower, $upper];
                $randomIndex = rand(0, 1); //Simple random logic
                $randomCase = $tempArray[$randomIndex];
                $word .= $randomCase;
                //If the string has digits, diplay 2 numbers at the same line
                if (is_numeric($letter)) {
                    echo "<h3 style='display: inline-block;'>$randomCase</h3>";
                    // Check if two letters have been displayed.
                    if (++$index % 2 == 0) {
                        echo "<br>"; // Move to the next line after displaying two letters.
                        $index = 0;
                    }
                }
                else {
                    // Display letters as they are; each in a new line.
                    echo "<h3>$randomCase</h3>";
                }
            
            }

            echo "<br>";
            
            $this->createAndManageInput();

            ?>
            <script>
                // Get the span element by its ID
                var wordSpan = document.getElementById('word');

                // Function to update the word in the hidden span
                wordSpan.innerText = "<?php echo $word; ?>";
            </script>
            <?php
        }

    } 
    


}

?>