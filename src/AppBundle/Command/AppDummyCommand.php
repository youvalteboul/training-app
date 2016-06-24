<?php

namespace AppBundle\Command;

use AppBundle\Entity\Tweet;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppDummyCommand extends ContainerAwareCommand
{
    /** @var EntityManager */
    protected $em;

    protected function configure()
    {
        $this->setName('app:dummy-command');
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User();
        $user->setUsername('shinework');
        $user->setEmail('badrien@jolicode.com');
        $this->em->persist($user);

        for ($i = 1; $i <= 1000; $i++) {
            $tweet = new Tweet();
            $tweet->setContent('tweet content');
            $tweet->setCreatedAt(new \DateTime());
            $tweet->setUsername('shinework');
            $tweet->setUser($user);

            $this->em->persist($tweet);
//            $this->em->flush();
        }

         $this->em->flush();
    }
}
