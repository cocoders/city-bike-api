<?php

namespace Cocoders\CityBike;

class DockingStation
{
    private $id;
    private $name;
    private $position;
    private $availableBikes;

    private $lat;
    private $long;

    public function __construct($id, $name, Position $position, $lat, $long)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->availableBikes = 0;
        $this->lat = $lat;
        $this->long = $long;
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

    public function getId()
    {
        return $this->id;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLong()
    {
        return $this->long;
    }
}
