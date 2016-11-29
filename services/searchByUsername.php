<?php
include_once "../Framework/DataAccess/DataAccess.php";
$username = $_POST["username"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->searchByUsername($username);
$array = [];
while ($row = $result->fetch_object()) {
    array_push($array, $row);
}
echo json_encode($array);

?>
