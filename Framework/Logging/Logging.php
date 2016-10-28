<?php

namespace Framework {
    require_once 'log4php/Logger.php';

    class Logging {

        /** Holds the Logger. */
        private $log;

        /** Logger is instantiated in the constructor. */
        public function __construct() {
            \Logger::configure('config.xml');
            $this->log = \Logger::getLogger(__CLASS__);
        }

        public function logDebug($message) {
            $this->log->debug($message);
        }

        public function logInfo($message) {
            $this->log->info($message);
        }

        public function logError($message) {
            $this->log->error($message);
        }

        public function logErrorException($ex) {
            $this->log->error($ex->getMessage());
        }

    }

}
?>