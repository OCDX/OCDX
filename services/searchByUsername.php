<?php
include_once "../Framework/DataAccess/DataAccess.php";
$username = $_POST["username"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->searchByUsername($username);

  echo json_encode($result);

 ?>
