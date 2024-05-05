<?php
require_once '../../src/features/Session.php';

SessionUtility::startSession();

$player = SessionUtility::getPlayerObject();

require '../templates/header.php';
$header = new Header("Knowledge Planet - Change Password Failed");
$header->render();
$message = $_GET[0];
?>
<div class="container">
    <form method="post" action="../../src/features/Account.php">
        <h2 style="color: rgb(192, 40, 17);"><?php echo $message ?></h2>
        <br>
        <h2>Return to Account Page</h2>
        <button type="submit" id="signInButton" name="signInButton" value="SEND">Account Page</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
