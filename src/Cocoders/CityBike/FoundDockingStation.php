<?php

namespace Cocoders\CityBike;

class FoundDockingStation
{
    public $name;
    public $long;
    public $lat;
    public $availableBikes;
    public $distance;

    public static function fromDockingStationAndDistance(DockingStation $dockingStation, $distance)
    {
        $foundDockingStation = new static();
        $foundDockingStation->name = $dockingStation->getName();
        $foundDockingStation->lat = $dockingStation->getPosition()->getLat();
        $foundDockingStation->long = $dockingStation->getPosition()->getLong();
        $foundDockingStation->availableBikes = $dockingStation->getAvailableBikes();
        $foundDockingStation->distance = $distance;

        return $foundDockingStation;
    }
}
