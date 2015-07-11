<?php

namespace Cocoders\CityBike;

interface FoundDockingStations
{
    /**
     * @param Position $startPosition
     * @param DockingStation[] $dockingStations
     * @return FoundDockingStation[]
     */
    public function search(Position $startPosition, $dockingStations);
}

