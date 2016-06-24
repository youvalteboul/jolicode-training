<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Post;

class CommandCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('Command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        for ($i=0; $i < 100; $i++) { 
            
            $post = new Post();

            $post->setTitle('Title ' . $i);
            $post->setDescription('Description ' . $i);

            $em->persist($post);
            

        }

        $em->flush($post);
    }

}
