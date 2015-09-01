<?php

namespace AppBundle\Command;

use Cocoders\CityBike\DockingStationsProvider;
use Cocoders\UseCase\UpdateAvailableBikes\Command;
use Cocoders\UseCase\UpdateAvailableBikes\Responder;
use Cocoders\UseCase\UpdateAvailableBikes\Response;
use Cocoders\UseCase\UpdateAvailableBikes\UpdateAvailableBikes;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

class UpdateAvailableBikesFromProviderCommand extends ContainerAwareCommand implements Responder
{
    private $dockingStationsFactory;
    /**
     * @var UpdateAvailableBikes
     */
    private $updateAvailableBikes;
    /** @var  ProgressBar */
    private $progress;
    /** @var  OutputInterface */
    private $output;

    public function __construct(DockingStationsProvider $dockingStationsProvider,
                                UpdateAvailableBikes $updateAvailableBikes)
    {
        $this->dockingStationsFactory = $dockingStationsProvider;
        $this->updateAvailableBikes = $updateAvailableBikes;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('update:all')
            ->setDescription('Update available bikes from provider website');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $dockingStationsNumber = $this->dockingStationsFactory->getAmount();

        $this->progress = new ProgressBar($output, $dockingStationsNumber);
        $this->progress->start();

        $stations = $this->dockingStationsFactory->getDockingStations();

        foreach ($stations as $station) {
            $this->updateAvailableBikes->execute(new Command(
                $station['id'],
                $station['availableBikes']), $this);
        }

        $this->progress->finish();
        echo "\nAvailable bikes successfully refreshed! \n";
    }

    public function updatedAvailableBikesOnStations(Response $response)
    {
        $this->progress->advance();
    }

    public function invalidDockingStation(Response $response)
    {
        $this->output->writeln('There is no station with id '. $response->getDockingStationId());
    }
}
