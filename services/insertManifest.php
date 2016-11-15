<?php

include_once "../Framework/DataAccess/DataAccess.php";
$standards = $_POST["standards"];
$comments = $_POST["comment"];
$userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
$title = $_POST["title"];

if($userId != '') {
    $dataAccess = new \DataAccess\DataAccess();
    $result = $dataAccess->insertManifest($standards, $comments, $userId, $title);
    if ($result->fetch_assoc()[0] > -1) {
        echo json_encode(["success" => true]);
    }
}
else{
    echo json_encode(["success" => false,"msg"=>"There is no username stored in session"]);
}
?>
