<?php

namespace Qbitz\SerwerSmsBundle\Tests\SerwerSms;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Qbitz\DpdBundle\Dpd\Data as Data;

class SerwerSmsClientTest extends WebTestCase {

    public function testSend() {
        $client = static::createClient()->getContainer()->get('qbitz.dpd.appservices');

        $resp = $client->send("test", "793795415");

        $this->assertTrue($resp);
    }

}
