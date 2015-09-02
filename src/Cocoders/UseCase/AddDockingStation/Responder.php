<?php

namespace Cocoders\UseCase\AddDockingStation;

use Cocoders\UseCase\Responder as BaseResponder;

interface Responder extends BaseResponder
{
    public function addedDockingStation(Response $response);
}
