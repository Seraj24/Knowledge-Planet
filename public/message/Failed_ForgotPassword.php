<?php
require '../templates/header.php';
require '../../src/features/Session.php';
require_once '../../Player.php';

SessionUtility::startSession();

$player = SessionUtility::getPlayerObject();


$header = new Header("Knowledge Planet - Forgot Password Failed");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/redirect.php">
        <h2 style="color: rgb(192, 40, 17);">The information you provided do not match an existing user</h2>
        <br>
        <h2>Return to Sign-In Page</h2>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Sign In</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
