<?php

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as FrameworkWebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class WebTestCase extends FrameworkWebTestCase
{
    public function getClient(array $options = [], array $server = [])
    {
        $client = self::createClient($options, $server);
        $this->resetDatabase($client);

        return $client;
    }

    public function resetDatabase (Client $client)
    {
        $output = new NullOutput();
        $application = new Application($client->getKernel());
        $application->setAutoExit(false);

        $application->run(new ArrayInput([
            'command' => 'doctrine:schema:drop',
            '--force' => true,
            '--no-interaction' => true,
            '--env' => 'test'
        ]), $output);
        $application->run(new ArrayInput([
            'command' => 'doctrine:schema:create',
            '--no-interaction' => true,
            '--env' => 'test'
        ]), $output);
    }
}