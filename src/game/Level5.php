<?php
require '../../public/templates/level_template.php';
require_once '../features/Redirector.php';
require_once '../features/Session.php';

SessionUtility::startSession();

$level = new Level('orange', "Select the highest and lowest letter of the word given below");

if ($_SESSION['lives'] > 0) {
    $level->render();
}
else {
    Router::redirectToPageWithMessage('../home/Main.php', 'Game Failed! Try again!', 'action');
}

?>

