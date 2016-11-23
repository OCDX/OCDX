<?php

include_once 'PHPUnit/phpunit-5.6.2.phar';

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicesTest
 *
 * @author Brandon
 */
class ServicesTest extends TestCase {

    public function testSuccessfulLogin() {
        $_POST = array(
            'username' => 'automated test',
            'password' => '123456'
        );
        require '../services/getUser.php';
        $this->expectOutputString("{\"success\":true,\"msg\":\"Login successfully!\"}");
        unset($_POST);
    }

    public function testSignupOfUserThatAlreadyExists(){
        $_POST = array(
            'username' => 'automated test',
            'password' => '123456'
        );
        require '../services/signup.php';
        $this->expectOutputString("{\"success\":false,\"msg\":\"automated test is already taken.\"}");
        unset($_POST);
    }
    public function testSuccessfulSignup() {
        $rand = rand();
        $_POST = array(
            'username' => 'automatedTestFromServices' . $rand,
            'password' => $rand
        );
        require '../services/signup.php';
        $this->expectOutputString("{\"success\":true,\"msg\":\"automatedTestFromServices" . $rand. " is created.\"}");
        unset($_POST);
    }

    public function testGetUserByUsername(){
        $_POST = array(
            'username' => 'dummyuser'
        );
        require '../services/searchByUsername.php';
        unset($_POST);
    }

    public function testSearchManifest(){
        $_POST = array(
            'searchField' => 'manifest'
        );
        require '../services/searchManifest.php';
        $this->hasOutput();
        unset($_POST);
    }

    public function testSearchManifestEmptyPOST(){
        require '../services/searchManifest.php';
        $this->expectOutputString(json_encode(["success"=>false, "msg" => "There was no search field"]));
    }

    public function testInsertManifest(){
        $_SESSION["user_id"] = 1;
        $_FILES = array(
            'test' => array(
                'name' => 'FileAccessTestFile.txt',
                'type' => 'text/plain',
                'size' => 58,
                'tmp_name' => 'FileAccessTestFile.txt',
                'error' => 0
            )
        );
        $_POST["standards"] = "automatedTest";
        $_POST["comment"] = "automatedTest";
        $_POST["title"] = "automatedTest";
        require '../services/insertManifest.php';
        $this->expectOutputString(json_encode(["success"=>true]));

        session_destroy();
    }

    public function testViewManifest(){
        $_POST["manifest"] = 42;
        require '../services/viewManifest.php';
        unset($_POST);
        $this->expectOutputString(json_encode(["standards_versions"=>"ocdxManifest schema v.1","date_created"=>"2016-10-31 03:26:02","comment"=>"The very first manifest.","user_id"=>1,"name"=>"filename2.json","format"=>"json","abstract"=>"Brief overview of file.","size"=>1000,"url"=>"http://url.com/2","checksum"=>"0","created_on"=>"2016-10-31 03:10:10"]));

    }


}
