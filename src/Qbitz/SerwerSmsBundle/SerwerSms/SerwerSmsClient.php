<?php

namespace Qbitz\SerwerSmsBundle\SerwerSms;

use Buzz\Browser;
use Buzz\Client\Curl;

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

    public function send($phoneNumber, $text, array $options = array()) {
        $options['akcja'] = 'wyslij_sms';
        $options['login'] = $this->login;
        $options['haslo'] = $this->password;
        $options['numer'] = $phoneNumber;
        $options['wiadomosc'] = $text;
        $options['test'] = $this->test==true;

        $buzz = new Browser(new Curl());
        $resp = $buzz->submit($this->url, $options);

        $dom = new \DomDocument;
        $dom->loadXML($resp->getContent());
        $xml = \simplexml_import_dom($dom);

        if (isset($xml->Blad)) {
            return 'smserror '.$phoneNumber.' ; '.$xml->Blad."\n";
        }

        if(isset($xml->Odbiorcy->Skolejkowane)){
            return true;
        }

        $log = '';
        if (isset($xml->Odbiorcy->Niewyslane)) {
            foreach($xml->Odbiorcy->Niewyslane->SMS as $sms) {
                $numer = '';
                $przyczyna = '';

                foreach($sms->attributes() as $name => $attr) {
                    if($name=='numer') {
                        $numer = $attr;
                    }
                    if($name=='przyczyna') {
                        $przyczyna = $attr;
                    }
                }

                $log .= 'smserror '.$numer.' ; '.$przyczyna."\n";
            }
        }

        return $log;
    }

}

?>
