<?php

namespace Cocoders\CityBike;

interface DockingStations
{
    /**
     * @param DockingStation $dockingStation
     * @return null
     */
    public function add(DockingStation $dockingStation);

    /**
     * @return DockingStation[]
     */
    public function findAll();
}

