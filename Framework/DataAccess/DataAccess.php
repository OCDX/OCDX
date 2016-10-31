<?php

namespace DataAccess {
    include("../Framework/Logging/Logging.php");

    class DataAccess {

        private $host = "ec2-54-145-239-64.compute-1.amazonaws.com";
        private $user = 'public';
        private $password = 'P@ssword';
        private $database = 'Group1OCDX';
        public $connection;

        public function __construct() {
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
        }

        public function getManifestById($manifest_id) {
            $stmt = $this->connection->prepare("CALL pGetManifestById(?)");
            $stmt->bind_param("i", $manifest_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $log = new \Framework\Logging();
                $log->logError("There was an error retreiving a manifest:" . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertManifest($standard_version, $creator, $comment) {
            $stmt = $this->connection->prepare("CALL pInsertManifest(?,?,?)");
            $stmt->bind_param("sss", $standard_version, $creator, $comment);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result == -1) {
                $log = new \Framework\Logging();
                $log->logError("There was an error inserting a manifest:" . $this->connection->error);
                return -1;
            }
            $stmt->close();
            return $result;
        }

        public function close() {
            return $this->connection->close();
        }

    }

}
?>