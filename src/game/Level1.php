<?php
require '../../public/templates/level_template.php';
require_once '../features/Redirector.php';
require_once '../features/Session.php';

SessionUtility::startSession();

$level = new Level('guitar', 'Sort the letters in Ascending order to complete this level.', 'Type each letter in the box below, using both upper and lower case as shown.');

if ($_SESSION['lives'] > 0) {
    $level->render();
}
else {
    Router::redirectToPageWithMessage('../home/Main.php', 'Game Failed! Try again.', 'action');
}

?>

