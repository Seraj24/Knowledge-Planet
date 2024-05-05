<?php
require '../templates/header.php';
$header = new Header("Knowledge Planet - Sign In Failed");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/redirect.php">
        <h2 style="color: rgb(192, 40, 17);"> <?php echo $_GET['errorMessage'] ?>! Please re-enter your information or create an account</h2>
        <br><br>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Try Again</button>
        <br><br>
        <button type="submit" id="signUpButton" name="signUpButton" value="SEND">Sign Up</button>
    </form>
    <form action="../forms/ForgotPassword.php">
        <br><br>
        <p>Forgot your password? change it by pressing the button below</p>
        <button type="submit" id="forgotPasswordButton" name="forgotPasswordButton" value="SEND">Change Password</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
