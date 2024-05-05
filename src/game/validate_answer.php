<?php
// This script validates each level of the letters and numbers game, providing feedback on correctness and managing game state.

require '../features/Session.php';

SessionUtility::startSession();

$response = array();
$correct = "Correct!";
$incorrect = "Incorrect!";

function levelOrderValidateLetters($asendingSort) {
    global $response, $correct, $incorrect;
    if (isset($_POST['word']) && isset($_POST['answer'])) {
        $word = $_POST['word'];
        $answer = $_POST['answer'];
        $match = true;

        $trimmedAnswer = preg_replace('/\s+/', '', trim($answer));

        $wordLettersArray = str_split($word);
        $answerLettersArray = str_split($trimmedAnswer);
        
        if ($asendingSort) {
            $sortedWordLettersArray = orderLettersAscending($wordLettersArray);
        }
        else {
            $sortedWordLettersArray = orderLettersDescending($wordLettersArray);
        }

        if (count($wordLettersArray) === count($answerLettersArray)) {
            $incorrectFields = 0;
            for ($i = 0; $i < count($sortedWordLettersArray); $i++) {
                if ($sortedWordLettersArray[$i] !== $answerLettersArray[$i]) {
                    $match = false;
                    $incorrectFields++;
                }
            }
        
            if ($match) {
                $response['result'] = $correct;
            }
            else if ($incorrectFields == count($sortedWordLettersArray)) {
                $response['result'] = $incorrect . " All your letters are different than ours";
            }
            else {
                $response['result'] = $incorrect . " Some of your letters are different than ours";
            }

        }
        else {
            $response['result'] = $incorrect . " Your letters are less or more than ours";
        }

        
    }
    else {
        $response['result'] = "None";
    }

}
function levelOrderValidateDigits($asendingSort) {
    global $response, $correct, $incorrect;
    if (isset($_POST['word']) && isset($_POST['answer'])) {
        $digits = $_POST['word'];
        $answer = $_POST['answer'];
        $match = true;

        $trimmedAnswer = trim($answer);
        
        //Seperate the digits into pairs since we are comparing 1 or 2 numbers at the same time
        $answerDigitsArray = explode(" ", $trimmedAnswer);
        if ($asendingSort) {
            $digitsArray = orderDigitsAscending($digits);
        }
        else {
            $digitsArray = orderDigitsDescending($digits);
        }
        
        if (count($digitsArray) === count($answerDigitsArray)) {
            $incorrectFields = 0;
            for ($i = 0; $i < count($digitsArray); $i++) {
                if ($answerDigitsArray[$i] !== $digitsArray[$i]) {
                    $match = false;
                    $incorrectFields++;
                }
            }

            if ($match) {
                $response['result'] = $correct;
            }
            else if ($incorrectFields == count($digitsArray)) {
                $response['result'] = $incorrect . " All your numbers are different than ours";
            }
            else {
                $response['result'] = $incorrect . " Some of your numbers are different than ours";
            }
        }
        else {
            $response['result'] = $incorrect . " Your numbers are less or more than ours";
        }

        
    }
    else {
        $response['result'] = "None";
    }

}

function levelSizeValidate($isDigit=false) {
    global $response, $correct, $incorrect;
    if (isset($_POST['word']) && isset($_POST['answer']) && isset($_POST['highest'])) {
        $word = $_POST['word'];
        $lowestLetter = $_POST['answer'];
        $biggestLetter = $_POST['highest'];

        $trimmedLower = trim($lowestLetter);
        $trimmedHigher = trim($biggestLetter);

        if($isDigit) {
            $wordLettersArray = $word;
        } 
        else {
            $wordLettersArray = str_split(($word));
        }
        
        if ($trimmedLower == findLower($wordLettersArray, $isDigit) && $trimmedHigher == findHigher($wordLettersArray, $isDigit)) {
            $response['result'] = $correct;
        }
        else {
            $response['result'] = $incorrect;
        }

        

    } 
    else {
        $response['result'] = "Error: Missing fields";
    }
    

}

function findLower($letters, $digits=false) {
    if (!$digits) {
        $sortedLetters = orderLettersAscending($letters);
    }
    else {
        $sortedLetters = orderDigitsAscending($letters);
    }
    return $sortedLetters[0];
}

function findHigher($letters, $digits=false) {
    if (!$digits) {
        $sortedLetters = orderLettersAscending($letters);
    }
    else {
        $sortedLetters = orderDigitsAscending($letters);
    }

    return $sortedLetters[count($sortedLetters) - 1];
}

function orderLettersAscending($letters) {
    sort($letters, SORT_FLAG_CASE | SORT_STRING);
    return $letters;
}

function orderLettersDescending($letters) {
    rsort($letters, SORT_FLAG_CASE | SORT_STRING);
    return $letters;
}

function orderDigitsAscending($digits) {
    // Split the digits into pairs
    $digitPairs = str_split($digits, 2);

    $n = count($digitPairs);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            // Convert the pairs to integers for comparison
            $intA = (int)$digitPairs[$j];
            $intB = (int)$digitPairs[$j + 1];

            // Swap if the pair is out of order
            if ($intA > $intB) {
                $temp = $digitPairs[$j];
                $digitPairs[$j] = $digitPairs[$j + 1];
                $digitPairs[$j + 1] = $temp;
            }
        }
    }

    return $digitPairs;
}

function orderDigitsDescending($digits) {
    return array_reverse(orderDigitsAscending($digits));
}


switch ($_SESSION['level']) {
    case 1:
        //Assending
        levelOrderValidateLetters(true);
        break;
    case 2:
        //Desending
        levelOrderValidateLetters(false);
        break;
    case 3:
        //Assending digits
        levelOrderValidateDigits(true);
        break;
    case 4:
        //Desending digits
        levelOrderValidateDigits(false);
        break;
    case 5:
        //Lowest and highest letters
        levelSizeValidate();
        break;
    case 6:
        //Lowest and highest digits
        levelSizeValidate(true);
        break;
    
}

if (empty($response)) {
    $response['result'] = "Invalid level or no response generated";
}

if($response['result'] != $correct) {
    if ($_SESSION['lives'] > 0) {
        $_SESSION['lives']--;
    }
}
else if ($response['result'] == $correct && $_SESSION['level'] == 6) {
    $_SESSION['status'] = 'win';
}

if ($_SESSION['lives'] <= 0) {
    $_SESSION['status'] = 'gameover';
    $response['result'] = "Game Failed!";
}

$response['lives'] = $_SESSION['lives'];

$response['level'] = $_SESSION['level'];




header('Content-Type: application/json');
echo json_encode($response);


?>