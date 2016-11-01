<?php

namespace DataAccess {
    include_once("../Framework/Logging/Logging.php");

    class DataAccess {

        private $host = "ec2-54-145-239-64.compute-1.amazonaws.com";
        private $user = 'public';
        private $password = 'P@ssword';
        private $database = 'OCDXGroup1';
        public $connection;
        private $logger = null;

        public function __construct() {
            if ($this->logger == null) {
                $this->logger = new \Framework\Logging();
            }
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
        }

        public function insertUser($username, $password) {
            $hpass = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->connection->prepare("CALL pInsertUser(?,?)");
            $stmt->bind_param("ss", $username, $hpass);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result == -1) {
                $this->loggger->logError("There was an error inserting a user:" . $this->connection->error);
                return -1;
            }
            $stmt->close();
            return $result;
        }

        public function getUserByUserName($username) {
            $stmt = $this->connection->prepare("CALL pGetUserByUserName(?)");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $this->loggger->logError("There was an error retreiving a user:" . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        /*
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
          } */

        public function close() {
            return $this->connection->close();
        }

    }

}
?>