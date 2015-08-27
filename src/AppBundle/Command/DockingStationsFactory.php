<?php

namespace AppBundle\Command;

use Cocoders\CityBike\DockingStation;

interface DockingStationsFactory
{
    /**
     * @return DockingStation[]
     */
    public function create();
}

