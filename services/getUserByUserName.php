<?php
include_once "../Framework/DataAccess/DataAccess.php";
$username = $_GET["username"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getUserByUserName($username);

  echo json_encode($result);

 ?>
