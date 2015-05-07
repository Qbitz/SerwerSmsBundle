<?php

namespace Qbitz\SerwerSmsBundle\Tests\SerwerSms;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Qbitz\DpdBundle\Dpd\Data as Data;

class SerwerSmsClientTest extends WebTestCase {

    public function testSend() {
        $client = static::createClient()->getContainer()->get('qbitz_serwer_sms.client');

        $resp = $client->send("793795415", "test");

        $this->assertTrue($resp);

        $resp = $client->send("+''\\\\''5415", "test");

        $this->assertStringStartsWith('smserror', $resp);
    }

}
