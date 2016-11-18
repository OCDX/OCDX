<?php

include_once "../Framework/DataAccess/DataAccess.php";
include_once "../Framework/FileAccess/FileAccess.php";
$standards = $_POST["standards"];
$comments = $_POST["comment"];
$userId = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '';
$title = $_POST["title"];

if($userId != '') {
   $dataAccess = new \DataAccess\DataAccess();
   $fileAccess = new \FileAccess\FileAccess();
   $result = $dataAccess->insertManifest($standards, $comments, $userId, $title);
   $manifestId = $result->fetch_assoc()['id'];
   if ($manifestId > -1) {
      $result1 = $dataAccess->insertResearchObject('','','','','','','','',$manifestId);
       $researchId = $result1->fetch_assoc()['id'];
       if($researchId > -1){
           foreach($_FILES as $file){
               if($fileAccess->uploadFile($file)) {
                   $result2 = $dataAccess->insertFile($file, '', $researchId);
               }
           }

           echo json_encode(["success" =>true]);
       }
   }
}
else{
   echo json_encode(["success" => false,"msg"=>"There is no username stored in session"]);
}
?>
