<?php
include_once "../Framework/DataAccess/DataAccess.php";

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getRecentlyAddedManifests();
$array = [];
while ($row = $result->fetch_object()) {
   array_push($array, $row);
}
echo json_encode($array);
?>
