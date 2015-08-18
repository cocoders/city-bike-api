<?php

namespace Cocoders\CityBike;

interface DockingStationsProvider
{
    /**
     * @return DockingStation[]
     */
    public function getAmount();
    public function saveStations();
}

