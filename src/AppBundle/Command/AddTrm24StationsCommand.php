<?php

namespace AppBundle\Command;

use Cocoders\CityBike\DockingStationsProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class AddTrm24StationsCommand extends ContainerAwareCommand
{
    private $dockingStationsFactory;

    public function __construct(DockingStationsProvider $dockingStationsProvider)
    {
        $this->dockingStationsFactory = $dockingStationsProvider;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('add:parse')
            ->setDescription('Parse docking stations from the selected site')
            ->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will execute without command prompt'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dockingStationsNumber = $this->dockingStationsFactory->getAmount();
        $text = "$dockingStationsNumber docking stations were found on page. ";

        if ($dockingStationsNumber < 1) {
            $output->writeln('No docking stations were found');
            return;
        }

        if ($input->getOption('force')) {
            $this->dockingStationsFactory->saveStations();
            $output->writeln((string) $dockingStationsNumber . ' docking stations saved. ');
            return;
        }

        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion($text .
            'Do you want to add them replacing existing stations (y / n)?', false);

        if ($helper->ask($input, $output, $question)) {
            $this->dockingStationsFactory->saveStations();
            return;
        }
    }
}

