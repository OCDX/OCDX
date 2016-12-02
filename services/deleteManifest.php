<?php

include_once "../Framework/DataAccess/DataAccess.php";
if (isset($_POST["manifestId"])) {
    $id = $_POST["manifestId"];

    $dataAccess = new \DataAccess\DataAccess();

        $result = $dataAccess->deleteManifest($id);
        if ($result == 1) {
            echo json_encode(["success" => true, "msg" => "Manifest has been deleted"]);
        } else {
            echo json_encode(["success" => false, "msg" => "Database error"]);
        }
} else {
    echo json_encode(["success" => false]);
}
?>
