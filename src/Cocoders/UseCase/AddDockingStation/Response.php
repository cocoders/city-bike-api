<?php

namespace Cocoders\UseCase\AddDockingStation;

use Cocoders\UseCase\Response as BaseResponse;

class Response implements BaseResponse
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
