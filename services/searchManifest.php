<?php
include_once "../Framework/DataAccess/DataAccess.php";
$searchField = $_GET["searchField"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getManifest($searchField);

  echo json_encode($result);
?>
