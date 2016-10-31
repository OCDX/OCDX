<?php

require_once 'PHPUnit/phpunit-5.6.2.phar';
require_once '../Framework/DataAccess/DataAccess.php';

use PHPUnit\Framework\TestCase;
use DataAccess\DataAccess;

class DataAccessTest extends TestCase {

    private $connection;

    public function testConnection() {
        $this->connection = new DataAccess();
        $this->assertEquals($this->connection->connection->ping(), true);
    }

    public function testInsertCreator() {
        $this->connection = new DataAccess();
        $this->assertEquals($this->connection->insertUser('automated test', '123456'), 1);
    }

    public function testGetUserByUserName() {
        $this->connection = new DataAccess();
        $result = $this->connection->getUserByUserName('automated test');
        $this->assertNotEquals($result, false);
    }

    /*
      public function testInsertManifest(){
      $this->connection = new DataAccess();
      $this->assertEquals($this->connection->insertManifest('1.0', 'automated test', 'This is an automated test'),1);
      }
      public function testGetManifestById(){
      $this->connection = new DataAccess();
      $result = $this->connection->getManifestById(1);
      $this->assertNotEquals($result,false);
      }
     */
}
