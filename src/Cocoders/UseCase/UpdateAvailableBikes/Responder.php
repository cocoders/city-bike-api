<?php

namespace Cocoders\UseCase\UpdateAvailableBikes;

use Cocoders\UseCase\Responder as BaseResponder;

interface Responder extends BaseResponder
{
    public function updatedAvailableBikesOnStations(Response $response);

    public function invalidDockingStation(Response $response);
}
