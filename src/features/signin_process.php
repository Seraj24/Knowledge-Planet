<?php
try {
    require "../../db/Database.php";
    require_once 'Redirector.php';
    require_once 'Session.php';
    require '../../Player.php';
    
    SessionUtility::startSession();
    
    if(isset($_POST["submitButton"])) {
        // Save the starting time to calculate the session time, it is used in session timeout script
        $_SESSION['StartTime'] = time();

        $username = $_POST["username"];
        $password = $_POST["password"];
        $firstName = null;
        $lastName = null;
        $database = new Database();

        $database->connectToMySQL("localhost", "root", "");
        $database->selectDatabase("php_game");
        $result =  $database->executeQuery("SELECT * FROM player WHERE username='$username'");
        $result2 = $database->executeQuery("
        SELECT p.username, p.registrationOrder, a.passCode, a.registrationOrder
        FROM player p 
        JOIN authenticator a ON p.registrationOrder = a.registrationOrder 
        WHERE p.username = '$username';
        ");
        if ($result === false || $result2 === false) {
            throw new Exception("Query execution failed.");
        }

        if ($result->num_rows > 0 && $result2->num_rows > 0) {

            $row = $result->fetch_assoc();
            $row2 = $result2->fetch_assoc();

            $passwordMatches = password_verify($password, $row2['passCode']);
            if ($passwordMatches) {
                $firstName = $row['firstName'];
                $lastName = $row['lastName'];
                $_SESSION['player'] = new Player($username, $firstName, $lastName, $password);
                Router::redirectToPage('../../src/home/Main.php');
            }
            else {
                throw new Exception("Invalid Password");
            }
        } else {
            throw new Exception("Username does not match an existing user");
        }

    }
} catch (Exception $e) {
    //Other exception might occur also
    Router::redirectToPageWithMessage('../../public/message/Failed_SignIn.php', urlencode($e->getMessage()));
}
    
?>