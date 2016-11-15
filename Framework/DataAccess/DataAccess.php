<?php

namespace DataAccess {
    include_once('../Framework/Logging/Logging.php');

    class DataAccess
    {

        public $connection;
        private $host = "ec2-54-145-239-64.compute-1.amazonaws.com";
        private $user = 'public';
        private $password = 'P@ssword';
        private $database = 'OCDXGroup1';
        private $logger = null;

        public function __construct()
        {
            if ($this->logger == null) {
                $this->logger = new \Framework\Logging();
            }
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
        }

        public function getUserByUserName($username)
        {
            $stmt = $this->connection->prepare("CALL pGetUserByUserName(?)");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $this->loggger->logError("There was an error retreiving a user: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function searchByUsername($username)
        {
            $stmt = $this->connection->prepare("CALL pSearchByUsername(?)");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $this->loggger->logError("There was an error retreiving a file by user name: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function searchManifest($searchField){
            $stmt = $this->connection->prepare("CALL pSearchManifest(?)");
            $stmt->bind_param("s", $searchField);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                $this->loggger->logError("There was an error searching a manifest: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertFile($file,$abstract,$researchId){
            $name = $file["name"];
            $type = explode(".",$name)[1];
            $size = $file["size"];
            $url = "/publicFiles/".$name;
            $checksum ="";
            $stmt = $this->connection->prepare("CALL pInsertFile(?,?,?,?,?,?,?)");
            $stmt->bind_param("sssissi", $name,$type,$abstract,$size,$url,$checksum,$researchId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($stmt->affected_rows == -1) {
                $this->loggger->logError("There was an error inserting a file: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertManifest($standardsVersion, $comment, $userId, $title)
        {
            $stmt = $this->connection->prepare("CALL pInsertManifest(?,?,?,?)");
            $stmt->bind_param("ssis", $standardsVersion, $comment, $userId, $title);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($stmt->affected_rows == -1) {
                $this->loggger->logError("There was an error inserting a manifest: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertResearchObject($title, $abstract, $oversight, $oversightType, $informedConsent, $privacy, $provenance, $permissions, $manifestId)
        {
            $stmt = $this->connection->prepare("CALL pInsertResearchObject(?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssisssssi", $title, $abstract, $oversight, $oversightType, $informedConsent, $privacy, $provenance, $permissions, $manifestId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($stmt->affected_rows == -1) {
                $this->loggger->logError("There was an error inserting a research object: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertResearcher($name, $role, $type, $contact)
        {
            $stmt = $this->connection->prepare("CALL pInsertResearcher(?,?,?,?)");
            $stmt->bind_param("ssss", $name, $role, $type, $contact);
            $stmt->execute();
            $result = $stmt->affected_rows;
            if ($stmt->affected_rows == -1) {
                $this->loggger->logError("There was an error inserting a researcher: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function insertUser($username, $password)
        {
            $hpass = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->connection->prepare("CALL pInsertUser(?,?)");
            $stmt->bind_param("ss", $username, $hpass);
            $stmt->execute();
            $result = $stmt->affected_rows;

            if ($result == -1) {
                $this->loggger->logError("There was an error inserting a user: " . $this->connection->error);
                return -1;
            }
            $stmt->close();
            return $result;
        }

        public function deleteManifest($manifest_id)
        {
            $stmt = $this->connection->prepare("CALL pDeleteManifest(?)");
            $stmt->bind_param("i", $manifest_id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            if ($result == -1) {
                $this->loggger->logError("There was an error deleting a manifest: " . $this->connection->error);
                return null;
            }
            $stmt->close();
            return $result;
        }

        public function close()
        {
            return $this->connection->close();
        }

    }

}
?>