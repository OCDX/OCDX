<?php
include_once "../Framework/DataAccess/DataAccess.php";

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getByteStat();

echo json_encode($result->fetch_object());

?>
