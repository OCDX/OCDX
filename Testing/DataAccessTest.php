<?php

include_once 'PHPUnit/phpunit-5.6.2.phar';
include_once '../Framework/DataAccess/DataAccess.php';

use PHPUnit\Framework\TestCase;
use DataAccess\DataAccess;

class DataAccessTest extends TestCase {

    private $connection;

    public function testConnection() {
        $this->connection = new DataAccess();
        $this->assertEquals($this->connection->connection->ping(), true);
    }

    public function testInsertUser() {
        $this->connection = new DataAccess();
        $rand = rand();
        $this->assertEquals($this->connection->insertUser('automatedTestInDataAccess' . $rand, $rand), 1);
    }

    public function testGetUserByUserName() {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('automated test');
        $this->assertEquals($result->fetch_assoc()["username"], 'automated test');
    }

    public function testGetUserByUserNameIncorrectUserName() {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('This is an nonexistant username');
        $this->assertEquals($result->num_rows, 0);
    }

    public function testGetFileByFileName(){
        $this->connection = new DataAccess();
        $result = $this->connection->searchByFilename('filename.json');
        $this->assertGreaterThan(0,$result->num_rows);
    }

    public function testGetFileByFileType(){
        $this->connection = new DataAccess();
        $result = $this->connection->searchByFiletype('json');
        $this->assertGreaterThan(0,$result->num_rows);
    }

    public function testGetFileByUsername(){
        $this->connection = new DataAccess();
        $result = $this->connection->searchByUsername('timthom');
        $this->assertGreaterThan(0,$result->num_rows);
    }

    public function testInsertingAndDeletingAManifest(){
        $this->connection = new DataAccess();
        $result = $this->connection->insertManifest('automatedTest','automatedTest',1,'automatedTest');
        $this->assertNotEquals($result,null);
        $result = $this->connection->deleteManifest($result->fetch_assoc()['id']);
        $this->assertNotEquals($result,null);
    }

    public function testInsertResearchObject(){
        $this->connection = new DataAccess();
        $result = $this->connection->insertResearchObject('automatedTest','automatedTest',0,'automatedTest','automatedTest','automatedTest','automatedTest','automatedTest',41);
        $this->assertNotEquals($result,null);
    }

}
