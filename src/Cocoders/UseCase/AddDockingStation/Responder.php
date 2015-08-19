<?php

namespace Cocoders\UseCase\AddDockingStation;

interface Responder extends \Cocoders\UseCase\Responder
{
    public function addedDockingStation(Response $response);
}
