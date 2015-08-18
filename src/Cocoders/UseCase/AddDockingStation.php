<?php

namespace Cocoders\UseCase;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use Cocoders\CityBike\Position;

class AddDockingStation
{
    /**
     * @var DockingStations
     */
    private $dockingStations;

    public function __construct(DockingStations $dockingStations)
    {
        $this->dockingStations = $dockingStations;
    }

    public function execute(AddDockingStationCommand $command)
    {
        $dockingStation = new DockingStation(
            $command->getId(),
            $command->getName(),
            new Position(
                $command->getLat(),
                $command->getLong()
            )
        );

        $this->dockingStations->add($dockingStation);
    }

}

