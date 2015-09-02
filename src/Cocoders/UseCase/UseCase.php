<?php

namespace Cocoders\UseCase;

interface UseCase
{
    public function execute(Command $command, Responder $responder);
}
