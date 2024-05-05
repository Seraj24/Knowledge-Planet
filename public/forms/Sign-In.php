<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Sign In");
$header->render();

?>
<div class="container">
    <?php 
        // Check if change password message exists and display it
        if (isset($_GET['changePasswordMessage'])) {
            $changePasswordMessage = $_GET['changePasswordMessage'];
            echo "<h2 style=\"color: rgb(15, 186, 15);\">$changePasswordMessage</h2>";
        }
    ?>
    <form method="post" action="../../src/features/signin_process.php">
        <label for="username">Username:</label>
        <input type="text" id="username2" name="username" placeholder="Enter your username...">
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password2" name="password" placeholder="Enter your password...">
        <br><br>          
        <button type="submit" value="send" name="submitButton">Sign In</button>
        <br><br>
    </form>
    <form method="post" action="ForgotPassword.php">
        <h3>Forgot your password? Reset it by clicking the button below</h3>
        <button type="submit" value="SEND" name="forgotPassword">Forgot Password</button>
    </form>
    <form method="post" action="../../src/features/redirect.php">
        <h3>Don't have an account? Create one by clicking the button below</h3>
        <button type="submit" value="SEND" name="signUpButton">Sign Up</button>
    </form>
</div>

<?php
require '../templates/footer.html';
?>

