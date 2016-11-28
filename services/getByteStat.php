<?php
include_once "../Framework/DataAccess/DataAccess.php";
$byteStat = $_GET byteStat;

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getByteStat($byteStat);

echo json_encode($result->fetch_assoc());

?>
