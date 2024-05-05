<?php
/*

This class is used to redirect to pages with specific location and specific message if needed

*/

class Router {

    public static function redirectToPage($location) {
        header('Location: ' . $location);
        exit();
    }

    public static function redirectToPageWithMessage($location, $message, $messageVariable='errorMessage') {
        header('Location: ' . $location . '?' . $messageVariable . '=' . $message);
        exit();
    }
}

?>