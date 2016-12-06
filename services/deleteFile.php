<?php

include_once "../Framework/DataAccess/DataAccess.php";
include_once "../Framework/FileAccess/FileAccess.php";
if (isset($_POST["fileId"])) {
    $id = $_POST["fileId"];

    $dataAccess = new \DataAccess\DataAccess();
    $fileAccess = new \FileAccess\FileAccess();
    $result = $dataAccess->deleteFile($id);
    $fileName = $result->fetch_row()[0];
    if ($fileName != null) {
        $fileAccess->deleteFile($fileName);
        echo json_encode(["success" => true, "msg" => "File has been deleted"]);
    } else {
        echo json_encode(["success" => false, "msg" => "Database error on delete file"]);
    }
} else {
    echo json_encode(["success" => false, "msg"=>"Post needs to be set"]);
}
?>
