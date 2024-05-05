<?php
session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
require '../templates/header.php';
$header = new Header("Knowledge Planet - Forgot Password Success");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/redirect.php">
        <h2 style="color: rgb(15, 186, 15);">Password Changed Successfully!</h2>
        <br><br>
        <h2>Please Sign-In</h2>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Sign In</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
