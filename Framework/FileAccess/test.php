<html>

    <form action="test.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="test" />
        <button type="submit" name="submit">Submit</button>
    </form>
</html>

<?php
if (isset($_POST["submit"])) {
    include_once "FileAccess.php";
    include_once '../Logging/Logging.php';
    $fileAccess = new FileAccess\FileAccess();
    $fileAccess->uploadFile($_FILES["test"]);
}
?>
