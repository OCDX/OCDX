<?php

include_once "../Framework/DataAccess/DataAccess.php";
if(isset($_POST["username"]) && isset($_POST["password"])){
$username = $_POST["username"];
$password = $_POST["password"];

$dataAccess = new \DataAccess\DataAccess();

//Check to see if the user already exists
$result = $dataAccess->getUserByUserName($username);
if($result->num_rows == 1){
    echo "{\"success\":\"false\"}";
}
else {
    $result = $dataAccess->insertUser($username, $password);

    if ($result == 1) {
        echo "{\"success\":\"true\"}";
    } else {
        echo "{\"success\":\"false\"}";
    }
}
}
else{
    echo "{\"success\":\"false\"}";
}
?>
