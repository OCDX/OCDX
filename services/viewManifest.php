<?php
include_once "../Framework/DataAccess/DataAccess.php";
$manifestId = isset($_POST["manifest"]) ? $_POST["manifest"] : '';

if ($manifestId != '') {
    $dataAccess = new \DataAccess\DataAccess();
    $result = $dataAccess->getManifestByManifestId($manifestId);
    echo json_encode($row = $result->fetch_object());
}
?>