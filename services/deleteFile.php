<?php

include_once "../Framework/DataAccess/DataAccess.php";
if (isset($_POST["fileId"])) {
    $id = $_POST["fileId"];

    $dataAccess = new \DataAccess\DataAccess();

    $result = $dataAccess->deleteFile($id);
    if ($result == 1) {
        echo json_encode(["success" => true, "msg" => "File has been deleted"]);
    } else {
        echo json_encode(["success" => false, "msg" => "Database error"]);
    }
} else {
    echo json_encode(["success" => false, "msg"=>"Post needs to be set"]);
}
?>
