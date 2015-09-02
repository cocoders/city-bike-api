<?php

namespace Cocoders\CityBike;

class DockingStation
{
    private $id;
    private $name;
    private $position;
    private $availableBikes;

    public function __construct($id, $name, Position $position)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->availableBikes = 0;
    }

    public function setAvailableBikes($availableBikes)
    {
        $this->availableBikes = (int) $availableBikes;
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

    public function getId()
    {
        return $this->id;
    }
}
