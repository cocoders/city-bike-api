<?php

namespace Cocoders\UseCase;

class AddDockingStationCommand
{
    private $id;
    private $name;
    private $lat;
    private $long;

    public function __construct($id, $name, $lat, $long)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lat = $lat;
        $this->long = $long;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

