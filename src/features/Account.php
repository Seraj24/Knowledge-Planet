<?php
    /* This script represents the account page where users can view their account information and reset their password. */

    require '../../db/Database.php';
    require '../../Player.php';
    require '../../public/templates/header.php';
    require_once 'Session.php';
    
    SessionUtility::startSession();

    $player = SessionUtility::getPlayerObject();

    $header = new Header("Knowledge Planet - Account Page");
    $header->render();
?>
<div class="container">
    <form method="post" action="Main_response.php">
        <h2>Welcome, <?php echo $player->getUsername(); ?></h2>
        <p>You can view your account Information and reset the password here</p>

        <h3><?php echo "Username: " . $player->getUsername() ?></h3>
        <h3><?php echo "First Name: " . $player->getFirstName() ?></h3>
        <h3><?php echo "Last Name: " . $player->getLastName() ?></h3>

    </form>
    <form action="PlayerHistory.php">
            <h3>View your rounds history</h3>
            <button type="submit" value="SEND" name="scoreButton">Your History</button>
    </form>
    <form action="../../public/forms/ChangePassword.php" method="post">
            <h3>To change your password, click the buttton below</h3>
            <button type="submit" value="SEND" name="changePasswordButton">Change Password</button>
    </form>
    <p>If you have any questions please contact us!</p>
</div>
<?php
require '../../public/templates/footer.html';
?>

