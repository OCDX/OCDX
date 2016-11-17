<?php
include_once "../Framework/DataAccess/DataAccess.php";
$searchField = isset($_POST["searchField"]) ? $_POST["searchField"] : '';

if($searchField == ''){
    echo  json_encode(["success"=>false, "msg" => "There was no search field"]);
}
else {
    $dataAccess = new \DataAccess\DataAccess();

    $result = $dataAccess->searchManifest($searchField);

    echo json_encode($result->fetch_assoc());
}
?>
