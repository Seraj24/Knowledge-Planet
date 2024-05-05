<?php

require 'db/Database.php';
require_once 'src/features/Redirector.php';

function createData() {
    $database = new Database();

    //Create database and tables when the user enters the website, Note: If they are already created, No effects occurs, it will just continue.
    $createData = new CreateData($database);

}

function checkSession() {
    if (!isset($_SESSION)){
        //Redirect to login form if the session expired
        Router::redirectToPage('public/forms/Sign-In.php');
    }
    else {
        //Redirect to home page if there is a session active
        Router::redirectToPage('src/home/Main.php');
    }
    
}

createData();
checkSession();
?>