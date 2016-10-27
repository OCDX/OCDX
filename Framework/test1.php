<?php
require_once 'Logging.php';
require_once 'log4php/Logger.php';
$logger = new Framework\Logging();
$logger->logDebug("This is a test from file 2");
?>