<?php
require_once 'Logging.php';
require_once 'log4php/Logger.php'; 
$test = "String";
echo $test;
$logger = new Framework\Logging();
$logger->logDebug("This is a test from file 1");
try{
    $test1 = $_POST["test"];
} catch (Exception $ex) {
$logger->logErrorException($ex);
}
echo "success";
?>