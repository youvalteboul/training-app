<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppCommandCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        for ($i=1;$i<=100;$i++) {
            $io->progressAdvance();
            sleep(1);
        }

        $io->progressFinish();
    }
}
