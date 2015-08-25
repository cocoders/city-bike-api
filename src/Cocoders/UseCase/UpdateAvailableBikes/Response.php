<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

class Response implements \Cocoders\UseCase\Response
{
    /**
     * @var
     */
    private $dockingStationId;

    /**
     * Response constructor.
     * @param $dockingStationId
     */
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
