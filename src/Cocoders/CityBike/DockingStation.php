<?php

namespace Cocoders\CityBike;

class DockingStation
{
    private $name;
    private $position;
    private $availableBikes;

    public function __construct($name, Position $position)
    {
        $this->name = $name;
        $this->position = $position;
        $this->availableBikes = 0;
    }

    public function setAvailableBikes($availableBikes)
    {
        $this->availableBikes = $availableBikes;
    }

    public function getAvailableBikes()
    {
        return $this->availableBikes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
