<?php

include_once 'PHPUnit/phpunit-5.6.2.phar';
include_once '../Framework/DataAccess/DataAccess.php';

use DataAccess\DataAccess;
use PHPUnit\Framework\TestCase;

class DataAccessTest extends TestCase
{

    private $connection;

    public function testConnection()
    {
        $this->connection = new DataAccess();
        $this->assertEquals($this->connection->connection->ping(), true);
    }

    public function testInsertUser()
    {
        $this->connection = new DataAccess();
        $rand = rand();
        $this->assertEquals(1, $this->connection->insertUser('automatedTestInDataAccess' . $rand, $rand));
    }

    public function testGetUserByUserName()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('automated test');
        $this->assertEquals('automated test', $result->fetch_assoc()["username"]);
    }

    public function testGetUserByUserNameIncorrectUserName()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('This is an nonexistant username');
        $this->assertEquals(0, $result->num_rows);
    }



    public function testGetFileByUsername()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->searchByUsername('timthom');
        $this->assertGreaterThan(0, $result->num_rows);
    }

    public function testInsertingAndDeletingAManifest()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->insertManifest('automatedTest', 'automatedTest', 1, 'automatedTest');
        $this->assertNotEquals(null, $result);
        $result = $this->connection->deleteManifest($result->fetch_assoc()['id']);
        $this->assertNotEquals(null, $result);
    }

    public function testInsertResearchObject()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->insertResearchObject('automatedTest', 'automatedTest', 0, 'automatedTest', 'automatedTest', 'automatedTest', 'automatedTest', 'automatedTest', 41);
        $this->assertNotEquals(null, $result);
    }

    public function testInsertResearcher(){
        $this->connection = new DataAccess();
        $result = $this->connection->insertResearcher('automatedTest', 'automatedTest','automatedTest','automatedTest');
        $this->assertNotEquals(null, $result);
    }

    public function testSearchManifest(){
        $this->connection = new DataAccess();
        $result = $this->connection->searchManifest('manifest');
        $this->assertNotEquals(null, $result);
    }

}
