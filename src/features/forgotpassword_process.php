<?php
/*

This script handles the submission of a form for resetting a forgotten password.
It checks if the form was submitted, retrieves user information from the database based on the submitted username, first name, and last name,
updates the password in the database, and redirects the user to a success or failure page accordingly.

*/

try {
    require '../../db/Database.php';
    require_once 'Redirector.php';
    // Check if the form was submitted
    if (isset($_POST["submitButton"])) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $password = $_POST["password"]; //New password

        $database = new Database();
        $database->connectToMySQL("localhost", "root", "");
        $database->selectDatabase("php_game");
        
        // Insert user information into the player table
        $execute = "
        SELECT p.firstName, p.lastName, p.username, p.registrationOrder, a.passCode, a.registrationOrder
        FROM player p
        JOIN authenticator a ON a.registrationOrder = p.registrationOrder
        WHERE p.username = '$username' AND p.firstName = '$firstName' AND p.lastName = '$lastName';
        ";
        $result = $database->executeQuery($execute);

        if ($result === false) {
            throw new Exception("Query execution failed.");
        }


        if ($result->num_rows > 0 ) {
        
            $row = $result->fetch_assoc();

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $execute = "
            UPDATE authenticator a
            SET passCode = '$hashedPassword'
            WHERE a.registrationOrder = '" . $row['registrationOrder'] . "';
            "; 

            $result2 = $database->executeQuery($execute);

            if ($result2 != false) { 
                Router::redirectToPage('../../public/message/Success_ForgotPassword.php');        
            }
            else {
                throw new Exception("Query 2 execution failed.");
            }


        } else {
            throw new Exception("User not found");
        }
    }
    else {
        throw new Exception("Form not submitted");
    }

}
catch (Exception $e) {
    Router::redirectToPageWithMessage('../../public/message/Failed_ForgotPassword.php', urlencode($e->getMessage()));
}

?>