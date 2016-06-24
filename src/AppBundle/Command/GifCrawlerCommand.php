<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use rfreebern\Giphy;
use Symfony\Component\Console\Style\SymfonyStyle;

class GifCrawlerCommand extends ContainerAwareCommand
{
    protected $client;

    protected function configure()
    {
        $this
            ->setName('gif:crawler')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->client = new Giphy();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $tableHeaders = ['Title', 'Link'];
        $tableRows = [];

        $tag = $io->ask('Indiquez le tag de recherche');
        $result = $this->client->search($tag, 10);

        $io->progressStart(10);

        foreach ($result->data as $gif) {
            $tableRows[] = [$gif->slug, $gif->images->fixed_height->url];
            $io->progressAdvance();
        }

        $io->progressFinish();
        $io->title(sprintf('Résultat de Gif pour le tag %s', $tag));
        $io->table($tableHeaders, $tableRows);

    }
}
