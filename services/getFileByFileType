<?php
include_once "../Framework/DataAccess/DataAccess.php";
$filetype = $_GET["filetype"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getFileByFileType($filetype);

  echo json_encode($result);

 ?>
