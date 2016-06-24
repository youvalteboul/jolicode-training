<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    /**
     * @dataProvider urlProvider
     */
    /*
    public function testPageIsSuccessful($url, $statusCode = 200)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        //$this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals($client->getResponse()->getStatusCode(), $statusCode);
    }
    public function urlProvider()
    {
        return array(
            array('/'),
            array('/upload/', 404),
            array('/upload/1'),
            array('/upload/4'),
        );
    }
    */
}
