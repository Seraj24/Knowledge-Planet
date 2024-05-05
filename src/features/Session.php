<?php
/*
    This class provides utility functions related to sessions.
*/

class SessionUtility {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getPlayerObject() {
        if(isset($_SESSION['player'])) {
            return $_SESSION['player'];
        } 
    }
}
?>