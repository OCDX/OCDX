<?php
include_once "../Framework/FileAccess/FileAccess.php";
$filePath = isset($_POST["filename"]) ? $_POST["filename"] : '';
if ($filePath != '') {
    $fileAccess = new \FileAccess\FileAccess();
    $file = $fileAccess->getFile(basename($filePath));
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($filePath). "\"");
    readfile($file);
}
?>