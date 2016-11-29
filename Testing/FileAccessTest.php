<?php

include_once 'PHPUnit/phpunit-5.6.2.phar';
include_once '../Framework/FileAccess/FileAccess.php';

use PHPUnit\Framework\TestCase;
use FileAccess\FileAccess;

class FileAccessTest extends TestCase {

    public function testUpload() {
        $_FILES = array(
            'test' => array(
                'name' => array('FileAccessTestFile.txt'),
                'type' => array('text/plain'),
                'size' => array(58),
                'tmp_name' => array('FileAccessTestFile.txt'),
                'error' => array(0)
            )
        );

        $fileAccess = new FileAccess();
        $this->assertEquals($fileAccess->uploadFile($_FILES["test"]), true);
        unset($_FILES);
    }

    public function testGet() {
        $fileAccess = new FileAccess();
        $this->assertNotEquals($fileAccess->getFile("FileAccessTestFile.txt"), false);
    }

    public function testUploadEmptyFile(){
        $fileAccess = new FileAccess();
        $this->assertEquals($fileAccess->uploadFile(null), false);
    }

}
