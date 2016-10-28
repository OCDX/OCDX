<?php
require_once 'PHPUnit/phpunit-5.6.2.phar';
require_once '../Framework/DataAccess/DataAccess.php';
use PHPUnit\Framework\TestCase;
use DataAccess\DataAccess;
class DataAccessTest extends TestCase {
    
     public function testConnection(){
         $connection = new DataAccess();      
         $this->assertEquals($connection->connection->ping(),true);
     }
}
