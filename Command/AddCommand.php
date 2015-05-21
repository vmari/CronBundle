<?php

namespace Crontab\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('crontab:add')
            ->setDescription('Add cron to your crontab.yml file')
            ->addArgument('format',InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Welcome to the crontab configurator</info>');
        $name = $input->getArgument('format');
        //TODO: add cron to the config file.
        $output->writeln($name);
    }
}
