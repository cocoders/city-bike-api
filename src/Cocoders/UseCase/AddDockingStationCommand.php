<?php

namespace Cocoders\UseCase;

class AddDockingStationCommand
{
    private $name;
    private $lat;
    private $long;

    /**
     * AddDockingStationCommand constructor.
     * @param $name
     * @param $lat
     * @param $long
     */
    public function __construct($name, $lat, $long)
    {
        $this->name = $name;
        $this->lat = $lat;
        $this->long = $long;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }


}

