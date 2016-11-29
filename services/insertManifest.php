<?php
include_once "../Framework/DataAccess/DataAccess.php";
include_once "../Framework/FileAccess/FileAccess.php";
include_once "../Framework/Logging/Logging.php";
$logger = new \Framework\Logging();
$standards = $_POST["standards"];
$comments = $_POST["comment"];
$title = $_POST["title"];
//session_start();
$userId = 0;

if(isset($_SESSION["user_id"]))
  $userId = $_SESSION["user_id"];

if($userId > 0) {
   $dataAccess = new \DataAccess\DataAccess();
   $fileAccess = new \FileAccess\FileAccess();
   $result = $dataAccess->insertManifest($standards, $comments, $userId, $title);
   $manifestId = $result->fetch_assoc();
   $manifestId = $manifestId['id'];
   if ($manifestId > -1) {
      $result1 = $dataAccess->insertResearchObject('','','','','','','','',$manifestId);
       $researchId = $result1->fetch_assoc()['id'];
       if($researchId > -1){
           $logger->logInfo("Inserted the manifest and the research object checking if there are any files");
           $logger->logInfo($_FILES);
           foreach($_FILES as $file){
               $logger->logInfo($file);
               if($fileAccess->uploadFile($file)) {
                   $logger->logInfo("File ".$file["name"][0]." successfully uploaded, now trying to insert into the database");
                   $result2 = $dataAccess->insertFile($file, '', $researchId);
               }
           }

           echo json_encode(["success" =>true,"manifestId"=>$manifestId]);
       }
   }
}
else{
   echo json_encode(["success" => false,"msg"=>"There is no username stored in session"]);
}
?>
