<?php
/* This script Shows personal records of all players */
require 'Session.php';
require '../../public/templates/history.php';
require_once '../../Player.php';

SessionUtility::startSession();

$history = new History(false);
$history->render();

?>
