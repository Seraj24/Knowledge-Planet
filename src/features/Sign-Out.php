<?php
/*
 * This script handles the sign-out process.
 * It clears all session variables, destroys the session, and redirects the user to the sign-in page.
 * If a change password message is present in the URL parameters, it includes that message in the redirection.
 */
    require_once 'Redirector.php';
    require_once 'Session.php';
    
    SessionUtility::startSession();

    $_SESSION = array();

    session_destroy();
    if ($_GET['changePasswordMessage']) {
        $changePasswordMessage = $_GET['changePasswordMessage'];
        Router::redirectToPageWithMessage('../../public/forms/Sign-In.php', urlencode($changePasswordMessage), 'changePasswordMessage');

    }

    Router::redirectToPage('../../public/forms/Sign-In.php');
?>