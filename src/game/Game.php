<?php
    /* This class manages the game flow, handles player actions, and updates the database with game results. */

    require '../../db/Database.php';
    require '../../Player.php';
    require_once 'LettersGame.php';
    require_once '../features/Session.php';
    require_once '../features/Redirector.php';

    SessionUtility::startSession();

    $player = SessionUtility::getPlayerObject();

    // If the cancel button is pressed and no status occuered such as winning, update session status as incomplete.
    if (isset($_POST['cancelButton']) && !isset($_SESSION['status'])) {
        $_SESSION['status'] = 'incomplete';
    }

    // If the user wins the game but does not click on finish button, like leaving to another page, automatically reset the game when player attempts to play again
    if (!isset($_POST['finishButton']) && isset($_SESSION['status']) && $_SESSION['status'] == 'win') {
        $_POST['finishButton'] = "SEND";
    }
    
    //Handle database operations for game results if session status exist.
    if (isset($_SESSION['status'])) {
        $registrationOrder = null; // Corrected spelling here
    
        $database = new Database();
        $database->connectToMySQL("localhost", "root", "");
        $database->selectDatabase("php_game");
        
        $execute = "
            SELECT p.registrationOrder 
            FROM player p
            WHERE p.username = '" . $player->getUsername() . "';
        ";
    
        $result = $database->executeQuery($execute);
        if ($result === false) {
            die("Query execution failed.");
        }
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $registrationOrder = $row['registrationOrder'];
        } else {
            die("User not found");
        }
    
        $lives = 6 - $_SESSION['lives'];
        $status = $_SESSION['status'];
    
        $execute = "
            INSERT INTO score (scoreTime, result, livesUsed, registrationOrder)
            VALUES (NOW(), '$status', '$lives', '$registrationOrder');
        ";
    
        $result2 = $database->executeQuery($execute);
        if ($result2 === false) {
            die("Query execution failed.");
        }
    
        unset($_SESSION['status']);
    
        // Success Insertion
    }
    

    //Game win handle
    if(isset($_POST['finishButton'])) {
        //Destroy the current game values
        unset($_SESSION['level']);
        unset($_SESSION['lives']);
        //Redirect to success page
        Router::redirectToPage('../../public/message/Success_Game.php');
    }


    //Cancel handle
    if (isset($_POST['cancelButton'])) {
        //Destroy the current game values
        unset($_SESSION['level']);
        unset($_SESSION['lives']);
        //Redirect to success page
        Router::redirectToPageWithMessage('../home/Main.php', "The game was cancelled successfully", "gameCancelled");
    }

    //If the player pressed the button with text 'Next Level' increase the level in order to redirect to the next level
    if (isset($_POST['submitLevel'])) {
        $_SESSION['level']++;
    }

    //Reset game level and lives if 'restartButton' is pressed.
    if (isset($_POST['restartButton'])) {
        $_SESSION['level'] = 1;
        $_SESSION['lives'] = 6;
    }


    //Redirect to the appropriate level based on the session level.
    switch ($_SESSION['level']) {
        case 1:
            Router::redirectToPage('Level1.php');
            break;
        case 2:
            Router::redirectToPage('Level2.php');
            break;
        case 3:
            Router::redirectToPage('Level3.php');
            break;
        case 4:
            Router::redirectToPage('Level4.php');
            break;
        case 5:
            Router::redirectToPage('Level5.php');
            break;
        case 6:
            Router::redirectToPage('Level6.php');
            break;
        default:
        Router::redirectToPage('../../public/message/LevelError.php');
        break;
    }



    

?>

