<?php

namespace Cocoders\CityBike;

interface FoundDockingStations
{
    /**
     * @param Position $startPosition
     * @return FoundDockingStation[]
     */
    public function search(Position $startPosition);
}

