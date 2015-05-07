<?php

namespace Qbitz\SerwerSmsBundle\SerwerSms;

class SerwerSmsClient {
    private $url;
    private $login;
    private $password;
    private $test;

    public function __construct($url, $login, $password, $test) {
        $this->url = $url;
        $this->login = $login;
        $this->password = $password;
        $this->test = $test;
    }

    public function send($phoneNumber, $text, $options = array()) {
        return true;
    }

}

?>
