<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

use Cocoders\UseCase\Response;

interface Responder extends \Cocoders\UseCase\Responder
{
    public function updatedAvailableBikesOnStations(Response $response);

    public function invalidDockingStation(Response $response);
}
