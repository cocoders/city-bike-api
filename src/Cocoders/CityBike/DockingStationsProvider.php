<?php

namespace Cocoders\CityBike;

interface DockingStationsProvider
{
    /**
     * @return integer
     */
    public function getAmount();


    /**
     * @return array
     */
    public function getDockingStations();
}
