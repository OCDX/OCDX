<?php

include_once "../Framework/DataAccess/DataAccess.php";
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $dataAccess = new \DataAccess\DataAccess();

//Check to see if the user already exists
    $result = $dataAccess->getUserByUserName($username);
    if ($result->num_rows == 1) {
        echo json_encode(["success" => false, "msg" => "$username is already taken."]);
    } else {
        $result = $dataAccess->insertUser($username, $password);

        if ($result == 1) {
            echo json_encode(["success" => true, "msg" => "$username is created."]);
        } else {
            echo json_encode(["success" => false, "msg" => "Database error"]);
        }
    }
} else {
    echo "{\"success\":\"false\"}";
}
?>
