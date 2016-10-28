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
        $this->assertTrue($this->connection->close());
    }
}
