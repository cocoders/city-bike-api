<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

use Cocoders\UseCase\Response as BaseResponse;

class Response implements BaseResponse
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
