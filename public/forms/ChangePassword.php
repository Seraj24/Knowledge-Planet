<?php
    require '../templates/header.php';
    require_once '../../src/features/Session.php';
    require_once '../../Player.php';

    SessionUtility::startSession();

    SessionUtility::getPlayerObject();


$header = new Header("Knowledge Planet - Change Password Form");
$header->render();
?>
<div class="container">
    <form method="post" action="../../src/features/changepassword_process.php">
        <h2>Password Reset</h2>
        <label for="currentPassword">Current Password:</label>
        <input type="password" name="currentPassword">
        <label for="">New Password: </label>
        <input type="password" name="newPassword">
        <br><br>
        <button type="submit" value="SEND" name="resetPasswordButton">Reset Password</button>
    </form>
</div>
<?php
require '../templates/footer.html';


?>

