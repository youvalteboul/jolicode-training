<?php

namespace AppBundle\Command;

use AppBundle\Entity\Gif;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use rfreebern\Giphy;
use Symfony\Component\Console\Input\InputOption;

class GifCrawlerCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:gif_crawler_command')
            ->setDescription('Hello PhpStorm')
            ->addOption('count', 'c', InputOption::VALUE_OPTIONAL, 'Nombre de gif max', 10)
        ;
    }

    /**
     * Interacts with the user.
     *
     * This method is executed before the InputDefinition is validated.
     * This means that this is the only place where the command can
     * interactively ask for values of missing required arguments.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
    }

    /**
     * Initializes the command just after the input has been validated.
     *
     * This is mainly useful when a lot of commands extends one main command
     * where some things need to be initialized based on the input arguments and options.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $ask = $io->ask("Indiquez le tag de recherche:");

        $count = $input->getOption('count');

        $io->progressStart($count);


        $giphy = new \rfreebern\Giphy();
        $giphies = $giphy->search($ask, $count, 0);

        //dump($giphies); exit();

        $em = $this->getContainer()->get('doctrine')->getManager();
        foreach ($giphies->data as $item) {
            $gif = new Gif();
            $gif
                ->setTitle($item->slug)
                ->setUrl($item->images->fixed_height->url)
                ->setType($ask)
            ;
            $em->persist($gif);
            $em->flush($gif);

            $rows[] = [$item->slug, $item->url, $ask];

            $io->progressAdvance();
        }

        $io->progressFinish();

        $io->title("Résultat de Gif pour le tag poney");

        $headers = ['Slug', 'Url', 'Type'];

        $io->table($headers, $rows);

    }
}
