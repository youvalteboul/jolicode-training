<?php

namespace Tests\AppBundle\Manager;

use AppBundle\Entity\Gif;
use AppBundle\Manager\GifManager;
USE Tests\AppBundle\WebTestCase;

class GifManagerTest extends WebTestCase
{

    /*
    private $client;
    private $entityManager;

    public function __construct($client, $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }
*/
    public function testSaveGifByTerm($term = 'poney', $count = 10)
    {
        //$client = $this::createClient();
        $client = $this->getClient();

        $em = $client->getContainer()->get('doctrine.orm.default_entity_manager');
        $gifClient = $client->getContainer()->get('giphy_client');

        $gifManager = new GifManager($gifClient, $em);

        $gifManager->saveGifByTerm('poney', 10);
        $this->assertEquals(10, count($em->getRepository(Gif::class)->findAll()));
    }
}