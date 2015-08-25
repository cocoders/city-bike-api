<?php

namespace Cocoders\UseCase\AddDockingStation;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use Cocoders\CityBike\Position;
use Cocoders\UseCase\Command;
use Cocoders\UseCase\InvalidCommandException;
use Cocoders\UseCase\InvalidResponderException;
use Cocoders\UseCase\Responder as BaseResponder;
use Cocoders\UseCase\UseCase;

class AddDockingStation implements UseCase
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
        if (!$command instanceof \Cocoders\UseCase\AddDockingStation\Command) {
            throw new InvalidCommandException;
        }

        if (!$responder instanceof \Cocoders\UseCase\AddDockingStation\Responder) {
            throw new InvalidResponderException;
        }

        $dockingStation = new DockingStation(
            $command->getId(),
            $command->getName(),
            new Position(
                $command->getLat(),
                $command->getLong()
            ),
            $command->getLat(),
            $command->getLong()
        );

        $this->dockingStations->add($dockingStation);
        $responder->addedDockingStation(new Response($dockingStation->getId()));
    }
}
