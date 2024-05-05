<?php
/*
This script handles page redirection based on authentication status.
It checks whether the current page requires authentication or not, and if the user is authenticated or not.
Depending on the authentication status and the page requirements, it redirects the user appropriately.
*/

require_once 'Redirector.php';
require_once 'Session.php';
    
SessionUtility::startSession();


//Pages that do not require authentication
$non_auth_pages = array(
    'Sign-In.php',
    'Sign-Up.php',
    'Failed_SignIn.php',
    'Failed_SignUp.php',
    'Success_SignUp.php',
    'ForgotPassword.php',
    'Failed_ForgotPassword.php',
    'Success_ForgotPassword.php',
    'AboutUs.php'
);

//Pages that require authentication
$auth_pages = array(
    'Main.php',
    'AboutUs.php',
    'Account.php', 
    'Level1.php',
    'Level2.php',
    'Level3.php',
    'Level4.php',
    'Level5.php',
    'Level6.php',
    'ChangePassword.php',
    'Success_Game.php',
    'Failed_ChangePassword.php',
    'PlayerHistory.php',
    'GlobalHistory.php'
);

//Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);

//Check authentication status and redirect if necessary
if (!in_array($current_page, $non_auth_pages) && !isset($_SESSION['player'])) {
    //Redirect to sign-in page
    Router::redirectToPage('../../public/forms/Sign-In.php');

} elseif (!in_array($current_page, $auth_pages) && isset($_SESSION['player'])) {
    //Redirect to main page
    Router::redirectToPage('../../src/home/Main.php');
}
?>
