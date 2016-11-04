<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FileAccess {
    if(isset($_SERVER['argv'])) {
        if (strpos($_SERVER['argv'][0], 'phpunit') !== FALSE) {
            include_once "../Framework/Logging/Logging.php";
        }
    }
    else{
        include_once "../Logging/Logging.php";
    }

    class FileAccess {

        private $baseDirectory = "/publicFiles/";
        private $logger = null;

        public function __construct() {
            if ($this->logger == null) {
                $this->logger = new \Framework\Logging();
            }
        }

        //this will take in a file from the FILES global array and try and upload it, returns true if successful, false if not
        public function uploadFile($file) {
            $targetFile = $this->baseDirectory . $file["name"];

            if (copy($file["tmp_name"], $targetFile)) {
                $this->logger->logInfo("The file " . $file["name"] . " was successfully uploaded");
                return true;
            } else {
                $this->logger->logInfo("The file " . $file["name"] . " failed to upload");
                return false;
            }
        }

        public function getFile($file) {
            $targetFile = $this->baseDirectory . $file;
            if (file_exists($targetFile)) {
                return file_get_contents($targetFile);
            }
            return "";
        }

    }

}