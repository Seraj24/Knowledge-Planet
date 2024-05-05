<?php
require '../templates/header.php';
require_once '../../Player.php';
require_once '../../src/features/Session.php';

SessionUtility::startSession();
$player = SessionUtility::getPlayerObject();
$header = new Header("Knowledge Planet - Game Success");
$header->render();
?>
<div class="container">
    <h2 style="color: rgb(15, 186, 15);">Congratulations! You have finished all the levels.</h2>
    <br><br>
    <h2>Play again or go back to home page</h2>
    <form method="post" action="../../src/game/Level1.php">
        <button type="submit" id="restartButton" name="signInButton" value="SEND">Play Again</button>
    </form>
    <br><br>
    <form method="post" action="../../src/home/Main.php">
        <button type="submit" id="restartButton" name="signInButton" value="SEND">Home Page</button>
    </form>
</div>
<?php
require '../templates/footer.html';
?>
