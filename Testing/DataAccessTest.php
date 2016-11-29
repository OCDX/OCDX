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
        $this->connection->close();
    }

    public function testInsertUser()
    {
        $this->connection = new DataAccess();
        $rand = rand();
        $this->assertEquals(1, $this->connection->insertUser('automatedTestInDataAccess' . $rand, $rand));
        $this->connection->close();
    }

    public function testGetUserByUserName()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('automated test');
        $this->assertEquals('automated test', $result->fetch_assoc()["username"]);
        $this->connection->close();
    }

    public function testGetUserByUserNameIncorrectUserName()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('This is an nonexistant username');
        $this->assertEquals(0, $result->num_rows);
        $this->connection->close();
    }


    public function testGetFileByUsername()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->searchByUsername('timthom');
        $this->assertGreaterThan(0, $result->num_rows);
        $this->connection->close();
    }

    public function testInsertingAndDeletingAManifest()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->insertManifest('automatedTest', 'automatedTest', 1, 'automatedTest');
        $this->assertNotEquals(null, $result);
        $result = $this->connection->deleteManifest($result->fetch_assoc()['id']);
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

    public function testInsertResearchObject()
    {
        $this->connection = new DataAccess();
        $result = $this->connection->insertResearchObject('automatedTest', 'automatedTest', 0, 'automatedTest', 'automatedTest', 'automatedTest', 'automatedTest', 'automatedTest', 41);
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

    public function testInsertResearcher(){
        $this->connection = new DataAccess();
        $result = $this->connection->insertResearcher('automatedTest', 'automatedTest','automatedTest','automatedTest');
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

    public function testInsertFile(){
        $_FILES = array(
            'test' => array(
                'name' => array('FileAccessTestFile.txt'),
                'type' => array('text/plain'),
                'size' => array(58),
                'tmp_name' => array('FileAccessTestFile.txt'),
                'error' => array(0)
            )
        );
        $this->connection = new DataAccess();
        $result = $this->connection->insertFile($_FILES["test"],"This is an automated test",1);
        $this->assertGreaterThan(-1, $result);
        $this->connection->close();

    }

    public function testSearchManifest(){
        $this->connection = new DataAccess();
        $result = $this->connection->searchManifest('manifest');
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

    public function testInsertFileEmptyFile(){
        $this->connection = new DataAccess();
        $result = $this->connection->insertFile(null,"This is an automated test",1);
        $this->assertEquals(-1, $result);
        $this->connection->close();
    }

    public function testGetByteStat(){
        $this->connection = new DataAccess();
        $result = $this->connection->getByteStat();
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

    public function testGetRecentlyAddedManifests(){
        $this->connection = new DataAccess();
        $result = $this->connection->getRecentlyAddedManifests();
        $this->assertNotEquals(null, $result);
        $this->connection->close();
    }

}
