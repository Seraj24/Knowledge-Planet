<?php
/*
This script is responsible for handling the change password functionality that avaliable in the Account page. It verifies the current password, updates it with a new one, 
and redirects the user accordingly.
*/
    require '../../db/Database.php';
    require 'Redirector.php';
    require '../../Player.php';
    require_once 'Session.php';
    class ChangePassword {
        private $player = null;

        public function __construct() {
            SessionUtility::startSession();

            $this->player = SessionUtility::getPlayerObject();

        }

        function processChangePassword() {
            try {
                if (isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['resetPasswordButton'])) {
                    $database = new Database();
                    $database->connectToMySQL("localhost", "root", "");
                    $database->selectDatabase("php_game");
            
                    $excute = "
                    SELECT a.passCode, a.registrationOrder, p.registrationOrder, p.username 
                    FROM player p
                    JOIN authenticator a ON a.registrationOrder = p.registrationOrder
                    WHERE p.username = '" . $this->player->getUsername() . "';
                    ";
                    
                    $result = $database->executeQuery($excute);
            
                    $resultInfo = $result->fetch_assoc();
            
                    $currentPassword = $_POST['currentPassword'];
            
                    $passwordMatches = password_verify($currentPassword, $resultInfo['passCode']);
            
                    if ($passwordMatches) {
                        $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                        $excute = "
                        UPDATE authenticator a
                        SET passCode = '$newPassword'
                        WHERE a.registrationOrder = '" . $resultInfo['registrationOrder'] . "';
                        ";
                        $result = $database->executeQuery($excute);
            
                        if ($result != false) {
                            Router::redirectToPageWithMessage('Sign-Out.php', 'Password%20changed%20successfully', 'changePasswordMessage');          
                        }
                    }
                    else {
                        throw new Exception("Password does not match");
                    } 
            
                    }
                else {
                    throw new Exception("ERROR: Missing Information to process");
                }
            }
            catch (Exception $e) {
                Router::redirectToPageWithMessage('../../public/message/Failed_ChangePassword.php', urldecode($e->getMessage()));
            }
            
        }
    }
    

    $changePassword = new ChangePassword();
    $changePassword->processChangePassword();
?>
