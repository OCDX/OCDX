<?php
include_once "../Framework/DataAccess/DataAccess.php";
$filename = $_GET["filename"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getFileByFileName($filename);

  echo json_encode($result);
