<?php

namespace AppBundle\Command;

class Trm24Factory implements DockingStationsFactory
{
    public function create()
    {
        return [1,2,3,4,56];
    }
}

