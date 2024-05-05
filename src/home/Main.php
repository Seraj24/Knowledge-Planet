<?php
    require '../../Player.php';
    require_once '../features/Session.php';
    require '../../public/templates/header.php';

    SessionUtility::startSession();

    $player = SessionUtility::getPlayerObject(); 

    $header = new Header("Knowledge Planet - Home");
    $header->render();
?>
<div class="container">
    <form method="post" action="../game/Game.php">
        <h1>🌟 Welcome to the Sorting Adventure, <?php echo $player->getUsername(); ?>! 🚀</h1>
        <div class="intro-text">
            <p class="intro">Hey there! Are you ready to embark on a thrilling sorting adventure with Professor Alphabet and Digit?</p>
            <p class="intro">Get ready to sharpen your sorting skills and conquer exciting challenges!</p>
            <p class="intro">Prepare to celebrate your victories and level up your sorting prowess! 🎉</p>
        </div>
        <?php
        if (isset($_GET['gameCancelled'])) {
            echo '<h2 style="color: #6EBE00">' . $_GET['gameCancelled'] . '</h2>';
        }
        if (isset($_GET['action'])) {
            echo '<h2 style="color: red">' . $_GET['action'] . '</h2>';
            unset($_SESSION['level']);
            unset($_SESSION['lives']); 
            unset($_GET['action']);
        }

        if (!isset($_SESSION['level'])) {
            $_SESSION['level'] = 1;
        }
        if (!isset($_SESSION['lives']) ) {
            $_SESSION['lives'] = 6;
        }

        

        if ($_SESSION['level'] > 1) {
            ?>
            <button type="submit" id="submitStart" name="submitStart" value="SEND">Resume</button>
            <button type="submit" id="restartButton" name="restartButton" value="SEND">Restart</button>
            <?php
        }
        else{
            ?>
            <button type="submit" id="submitStart" name="submitStart" value="SEND">Play</button>
            <?php
        }
        ?>
        <br><br>
        <p>Feel free to explore and enjoy!</p>
    </form>
</div>
<?php
require '../../public/templates/footer.html';
?>

