<?php
/* Redirect to sign in or sign up pages since they are common in non auth pages */
require 'Redirector.php';
if(isset($_POST["signInButton"])) {
    Router::redirectToPage('../../public/forms/Sign-In.php');
}
elseif(isset($_POST["signUpButton"])) {
    Router::redirectToPage('../../public/forms/Sign-Up.php');
}
?>