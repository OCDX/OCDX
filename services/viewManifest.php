<?php
include_once "../Framework/DataAccess/DataAccess.php";
$manifestId = isset($_POST["manifest"]) ? $_POST["manifest"] : '';

if ($manifestId != '') {
    $dataAccess = new \DataAccess\DataAccess();
    $result = $dataAccess->getManifestByManifestId($manifestId);
    $files = [];
    if ($result != null) {
        $output = new stdClass();
        $row = $result->fetch_assoc();
        if ($row != null) {
            $values = array_splice($row, 0, 5);
            $output->standards_versions = $values["standards_versions"];
            $output->date_created = $values["date_created"];
            $output->comment = $values["comment"];
            $output->username = $values["username"];
            $output->title = $values["title"];
            array_push($files, $row);
            while ($row = $result->fetch_assoc()) {
                array_splice($row, 0, 5);
                array_push($files, $row);
            }
            $output->files = $files;
            echo json_encode($output);
        } else {
            echo json_encode(["success" => false, "msg" => "The id does not exist"]);
        }
    } else {
        echo json_encode(["success" => false, "msg" => "The id does not exist"]);
    }
} else {
    echo json_encode(["success" => false]);
}
?>