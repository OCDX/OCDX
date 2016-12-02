<?php
include_once "../Framework/DataAccess/DataAccess.php";
$standards = $_POST["standards"];
$comments = $_POST["comment"];
$title = $_POST["title"];
$manifestId = $_POST["manifestId"];

    $dataAccess = new \DataAccess\DataAccess();
    $result = $dataAccess->updateManifest($standards, $comments, $title,$manifestId);
    if(result == 1){
        echo json_encode(["success"=>true]);
    }
    else{
        echo json_encode(["success"=>false]);
    }
?>
