<?php
require '../../db/Database.php';
require '../../Player.php';
require_once 'Redirector.php';
require_once 'Validator.php';



// Check if the form was submitted
if (isset($_POST["submitButton"])) {
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $password = $_POST["password"];

    $commonErrorMessage = "Sorry! Sign up failed. ";

    //Additonal validation to ensure that data is correct before sending it to the database
    try {
        // Validate username
        $usernameError = SignUpValidator::validateUsername($username);
        if ($usernameError) {
            throw new Exception($commonErrorMessage . $usernameError);
        }

        // Validate first name
        $firstNameError = SignUpValidator::validateFirstName($firstName);
        if ($firstNameError) {
            throw new Exception($commonErrorMessage . $firstNameError);
        }

        // Validate last name
        $lastNameError = SignUpValidator::validateLastName($lastName);
        if ($lastNameError) {
            throw new Exception($commonErrorMessage . $lastNameError);
        }

        // Validate password
        $passwordError = SignUpValidator::validatePassword($password);
        if ($passwordError) {
            throw new Exception($commonErrorMessage . $passwordError);
        }
    }
    catch (Exception $e) {
        Router::redirectToPageWithMessage("../../public/message/Failed_SignUp.php", $e->getMessage());
    }

    $database = new Database();
    $player = new Player($username, $firstName, $lastName, $password);
    try {
        $database->connectToMySQL("localhost", "root", "");
        $database->selectDatabase("php_game");
        
        //Insert user information into the player table
        $executePlayer = "INSERT INTO player (username, firstName, lastName, registrationTime) VALUES ('" . $player->getUsername() . "', '" . $player->getFirstName() . "', '" . $player->getLastName() . "', now())";
        $database->executeQuery($executePlayer);

        //Insert password into the authenticator table
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Hashing the password
        $executeAuthenticator = "INSERT INTO authenticator (passCode, registrationOrder) SELECT '$hashedPassword', registrationOrder FROM player WHERE username = '$username'";
        $database->executeQuery($executeAuthenticator);

        $database->closeMySQL();

        //Redirect to success page
        Router::redirectToPage('../../public/message/Success_SignUp.php');
    } catch (Exception $e) {
        //Redirect to error page if an exception occurs
        Router::redirectToPageWithMessage('../../public/message/Failed_SignUp.php', urlencode($e->getMessage()));
    }
} else {
    //Redirect to error page if form was not submitted
    Router::redirectToPageWithMessage('../../public/message/Failed_SignUp.php', "Form not submitted"); 
}
?>
