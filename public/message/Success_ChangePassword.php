<?php
session_start();

require '../templates/header.php';
$header = new Header("Knowledge Planet - Change Password Success");
$header->render();
?>
<!-- <meta http-equiv="refresh" content="5;url=../../src/features/Sign-Out.php"/> -->
<div class="container">
    <form method="post" action="../../src/features/Sign-Out.php">
        <h2 style="color: rgb(15, 186, 15);">Password Changed Successfully!</h2>
        <br><br>
        <h2>You will be redirected automatically in 5 seconds to Sign in page in but you can also Re-SignIn by clicking the button below</h2>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Sign In</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
