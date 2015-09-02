<?php

namespace Cocoders\CityBike;

interface DockingStationsProvider
{
    /**
     * @return integer
     */
    public function getNumberOfDockingStations();

    /**
     * @return array
     */
    public function getDockingStations();
}
