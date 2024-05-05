<?php
require_once '../../src/features/Session.php';
require_once '../../Player.php';

SessionUtility::startSession();
$player = SessionUtility::getPlayerObject();
?> 
<nav>
    <ul>
        <li><a href="../../src/home/Main.php">Home</a></li>
        <li><a href="../../src/features/Sign-Out.php">Sign Out</a></li>
        <li><a href="../../src/features/Account.php?username=<?php echo $player->getUsername(); ?>">Account</a></li>
        <li><a href="../../src/features/GlobalHistory.php?username=<?php echo $player->getUsername(); ?>">History</a></li>
        <li><a href="../../public/message/AboutUs.php">About</a></li>
    </ul>
</nav>