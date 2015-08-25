<?php

namespace AppBundle\Command;

use Cocoders\CityBike\DockingStationsProvider;
use Cocoders\UseCase\AddDockingStation\AddDockingStation;
use Cocoders\UseCase\AddDockingStation\Command;
use Cocoders\UseCase\AddDockingStation\Responder;
use Cocoders\UseCase\AddDockingStation\Response;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class AddDockingStationsFromProviderCommand extends ContainerAwareCommand implements Responder
{
    private $dockingStationsFactory;
    /**
     * @var AddDockingStation
     */
    private $addDockingStation;
    /** @var  ProgressBar */
    private $progress;

    public function __construct(DockingStationsProvider $dockingStationsProvider, AddDockingStation $addDockingStation)
    {
        $this->dockingStationsFactory = $dockingStationsProvider;
        $this->addDockingStation = $addDockingStation;

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
            $this->dockingStationsFactory->getDockingStations();
            $output->writeln((string) $dockingStationsNumber . ' docking stations saved. ');
            return;
        }

        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion($text .
            'Do you want to add them replacing existing stations (y / n)?', false);

        if (!$helper->ask($input, $output, $question)) {
            return;
        }

        $this->progress = new ProgressBar($output, $dockingStationsNumber);
        $this->progress->start();

        $stations = $this->dockingStationsFactory->getDockingStations();

        foreach ($stations as $station) {
            $this->addDockingStation->execute(new Command(
                $station['id'],
                $station['name'],
                $station['lat'],
                $station['long']
            ), $this);
        }

        $this->progress->finish();
        echo "\n";
    }

    public function addedDockingStation(Response $response)
    {
       $this->progress->advance();
    }
}
