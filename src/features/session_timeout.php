<?php
/*
   This script is intended to be included in files where a session has already been started.
   It defines a session timeout of 15 minutes.
*/
require_once 'Redirector.php';
// Script must be placed within a file that already started a session
define("SESSION_TIMEOUT", 900); //15 minutes
// Check if the session exists
if (!isset($_SESSION['last_activity'])) {
    // Session doesn't exist or has expired, perform logout or redirect to login page
    $elapsed_time = time() - $_SESSION['StartTime'];

    $includingScriptDirectory = dirname($_SERVER['SCRIPT_FILENAME']);
    $directoryName = basename($includingScriptDirectory);


    // If elapsed time exceeds the session timeout, destroy the session
    if ($elapsed_time >= SESSION_TIMEOUT) {
        if ($directoryName != "features") {
            Router::redirectToPage('../../src/features/Sign-Out.php');
        }
        Router::redirectToPage('Sign-Out.php'); // Redirect to Sign out script
    }
}
?>