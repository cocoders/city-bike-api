<?php

namespace Cocoders\InMemory\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations as DockingStationsRepository;
use Cocoders\CityBike\FoundDockingStation;
use Cocoders\CityBike\FoundDockingStations as FoundDockingStationsInterface;
use Cocoders\CityBike\Position;

final class FoundDockingStations implements FoundDockingStationsInterface
{
    private $dockingStationsRepository;

    public function __construct(DockingStationsRepository $dockingStations)
    {
        $this->dockingStationsRepository = $dockingStations;
    }
    /**
     * @param Position $startPosition
     * @param DockingStation[] $dockingStations
     * @return FoundDockingStation[]
     */
    public function search(Position $startPosition)
    {
        $dockingStations = $this->dockingStationsRepository->findAll();
        $foundDockingStations = [];

        foreach ($dockingStations as $dockingStation) {
            $foundDockingStations[] = FoundDockingStation::fromDockingStationAndDistance(
                $dockingStation,
                $startPosition->calculateDistance($dockingStation->getPosition())
            );
        }

        usort($foundDockingStations, function (FoundDockingStation $a, FoundDockingStation $b) {
            if ($a->distance == $b->distance) {
                return 0;
            }

            return $a->distance < $b->distance ? -1 : 1;
        });

        return $foundDockingStations;
    }
}
