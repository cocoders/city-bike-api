<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use Cocoders\UseCase\Command;
use Cocoders\UseCase\InvalidCommandException;
use Cocoders\UseCase\InvalidResponderException;
use Cocoders\UseCase\Responder as BaseResponder;
use Cocoders\UseCase\UseCase;

class UpdateAvailableBikes implements UseCase
{
    /**
     * @var DockingStations
     */
    private $dockingStations;

    public function __construct(DockingStations $dockingStations)
    {
        $this->dockingStations = $dockingStations;
    }

    public function execute(Command $command, BaseResponder $responder)
    {
        if (!$command instanceof \Cocoders\UseCase\UpdateAvailableBikes\Command) {
            throw new InvalidCommandException;
        }

        if (!$responder instanceof \Cocoders\UseCase\UpdateAvailableBikes\Responder) {
            throw new InvalidResponderException;
        }

        $dockingStation = $this->dockingStations->find($command->getId());

        if (!$dockingStation) {
            $responder->invalidDockingStation(new Response($command->getId()));
            return;
        }


        $dockingStation->setAvailableBikes($command->getAvailableBikes());
        $this->dockingStations->add($dockingStation);

        $responder->updatedAvailableBikesOnStations(new Response($dockingStation->getId()));
    }
}
