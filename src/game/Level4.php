<?php
require '../../public/templates/level_template.php';
require_once '../features/Redirector.php';
require_once '../features/Session.php';

SessionUtility::startSession();

$randomNumbers = "";

//Array to keep track of generated digits
$generatedDigits = [];

// Keep generating random numbers until we have 6 unique digits
while (count($generatedDigits) < 6) {
    $randomGen = rand(0, 100);
    if (!in_array($randomGen, $generatedDigits)) {
        $randomNumbers .= $randomGen;
        $generatedDigits[] = $randomGen; 
    }
}


$level = new Level($randomNumbers, "Sort The Following Numbers in Decending order: ", "Write each pair of numbers then a space to the next one. Example: 40 30 20...");

if ($_SESSION['lives'] > 0) {
    $level->render();
}
else {
    Router::redirectToPageWithMessage('../home/Main.php', 'Game Failed! Try again!', 'action');
}

?>

