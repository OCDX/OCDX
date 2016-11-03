<?php

include_once "../Framework/DataAccess/DataAccess.php";
$username = $_GET["username"];
$password = $_GET["password"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->insertUser($username, $password);

if($result == 1){
        echo "{\"success\":\"true\"}";
}
else{
       echo "{\"success\":\"false\"}";
}
?>
