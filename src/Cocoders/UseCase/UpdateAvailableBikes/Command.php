<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

use Cocoders\UseCase\Command as BaseCommand;

class Command implements BaseCommand
{
    private $id;
    private $availableBikes;

    /**
     * Command constructor.
     * @param $id
     * @param $availableBikes
     */
    public function __construct($id, $availableBikes)
    {
        $this->id = $id;
        $this->availableBikes = $availableBikes;
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
    public function getAvailableBikes()
    {
        return $this->availableBikes;
    }
}
