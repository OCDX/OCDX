<?php
include_once "../Framework/DataAccess/DataAccess.php";
$username = $_POST["username"];
$password = $_POST["password"];

$dataAccess = new \DataAccess\DataAccess();

$result = $dataAccess->getUserByUserName($username);
$row = $result->fetch_assoc();
if (password_verify($password, $row["hashed_password"])) {
    echo json_encode(["success" => true, "msg" => "Login successfully!"]);
    $_SESSION["key"] = rand();
} else {
    echo json_encode(["success" => false, "msg" => "Please try again!"]);
}
?>
