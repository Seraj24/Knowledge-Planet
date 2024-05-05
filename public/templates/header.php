<?php
// The Header class represents the header section of the Knowledge Planet website pages.
// It includes the website title, navigation menu, and authentication status.

class Header {
    // Property to hold the title of the page.
    private $title;
    // Constructor to initialize the title (default is "Knowledge Planet").
    public function __construct($title="Knowledge Planet") {
        $this->title = $title;
    }

    // Method to render the header HTML content.
    public function render() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $this->title ?></title>
        <link rel="stylesheet" href="../../public/assets/css/style.css">
        </head>
        <body>
        <header>
            <h1 id="websiteHeader">Knowledge Planet</h1>
            <?php
            require '../../src/features/authentication.php';

            
            if(isset($_SESSION['player'])) {
                require 'sign_in_menu.php'; 
                require '../../src/features/session_timeout.php';
            } else {
                require 'sign_out_menu.php';
            }
            ?>

        </header>
        <?php
    }
}
?>