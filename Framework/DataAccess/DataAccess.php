<?php

namespace DataAccess {

    class DataAccess {
        private $host = "ec2-54-145-239-64.compute-1.amazonaws.com";
        private $user = 'public';
        private $password = 'P@ssword';
        private $database = 'Group1OCDX';
        public $connection;

        public function __construct() {
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
        }

        public function __destruct() {
            $this->connection->close();
        }

    }

}
?>