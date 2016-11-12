<?php

include_once "../Framework/DataAccess/DataAccess.php";
$standards = $_POST["standards"];
$comments = $_POST["comment"];
$userid = $_POST["userid"];
$title = $_POST["title"];

  $dataAccess = new \DataAccess\DataAccess();
  $result = $dataAccess->insertManifest($standards,$comments,$userid,$title);
  if($result->fetch_assoc()[0] > -1){
      echo json_encode(["success"=>true]);
  }
?>
