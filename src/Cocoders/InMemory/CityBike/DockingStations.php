<?php

namespace Cocoders\InMemory\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations as DockingStationsInterface;

final class DockingStations implements DockingStationsInterface
{
    private $stations = [];

    /**
     * @param DockingStation $dockingStation
     * @return null
     */
    public function add(DockingStation $dockingStation)
    {
        $this->stations[] = $dockingStation;
    }

    /**
     * @return DockingStation[]
     */
    public function findAll()
    {
        return $this->stations;
    }

    /**
     * @return DockingStation
     */
    public function find($id)
    {
        /** @var DockingStation $station */
        foreach ($this->stations as $station) {
            if ($station->getId() == $id) {
                return $station;
            }
        }
    }
}
