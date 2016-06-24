<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Gif;

class GifManager
{

    private $client;
    private $entityManager;

    public function __construct($client, $entityManager)
    {
        $this->client = $client;
        $this->entityManager = $entityManager;
    }

    public function saveGifByTerm($term, $count = 10)
    {

        $giphies = $this->client->search($term, $count, 0);

        $em = $this->entityManager;
        foreach ($giphies->data as $item) {
            $gif = new Gif();
            $gif->setTitle($item->slug)
                ->setUrl($item->images->fixed_height->url)
                ->setType($term);
            $em->persist($gif);
        }
        $em->flush($gif);
    }
}