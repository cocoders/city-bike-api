<?php

namespace Cocoders\UseCase\AddDockingStation;

class Response implements \Cocoders\UseCase\Response
{
    /**
     * @var
     */
    private $dockingStationId;

    public function __construct($dockingStationId)
    {
        $this->dockingStationId = $dockingStationId;
    }

    /**
     * @return mixed
     */
    public function getDockingStationId()
    {
        return $this->dockingStationId;
    }
}
