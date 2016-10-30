<?php

namespace DataAccess {



    class DataAccess {

        private $host = "ec2-54-145-239-64.compute-1.amazonaws.com";
        private $user = 'public';
        private $password = 'P@ssword';
        private $database = 'Group1OCDX';
        private $logger;

        public function __construct() {
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
        }

        public function getManifestById() {
            if (!$this->connection->query("CALL pGetManfestById()")) {
                
            }
        }

        public function insertManifest($standard_version, $creator, $comment) {
            $this->connection->query("SET @standard_version  = " . "'" . $this->connection->real_escape_string($standard_version) . "'");
            $this->connection->query("SET @creator  = " . "'" . $this->connection->real_escape_string($creator) . "'");
            $this->connection->query("SET @comment  = " . "'" . $this->connection->real_escape_string($comment) . "'");

            if (!$this->connection->query("CALL pInsertManifest(@standard_version,@creator,@comment)")) {
                die("CALL failed: (" . $this->connection->errno . ") " . $this->connection->error);
                return -1;
            }
            return $this->connection->affected_rows;
        }

        public function close() {
            return $this->connection->close();
        }

    }

}
?>