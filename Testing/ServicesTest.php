<?php

include_once 'PHPUnit/phpunit-5.6.2.phar';

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicesTest
 *
 * @author Brandon
 */
class ServicesTest extends TestCase {

    public function testSuccessfulLogin() {
        $_GET = array(
            'username' => 'automated test',
            'password' => '123456'
        );
        require '../services/getUser.php';
        $this->expectOutputString("{\"success\":\"true\"}");
        unset($_GET);
    }

    public function testSuccessfulSignup() {
        $rand = rand();
        $_POST = array(
            'username' => 'automatedTestFromServices' . $rand,
            'password' => $rand
        );
        require '../services/signup.php';
        $this->expectOutputString("{\"success\":\"true\"}");
        unset($_GET);
    }

}
