<?php

namespace spec\Cocoders\InMemory\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DockingStationsSpec extends ObjectBehavior
{
    function it_is_docker_station_collection()
    {
        $this->shouldHaveType('Cocoders\CityBike\DockingStations');
    }

    function it_allows_to_store_docking_station(
        DockingStation $dockingStation,
        DockingStation $dockingStation2
    ) {
        $this->add($dockingStation);
        $this->add($dockingStation2);

        $this->findAll()->shouldBe([
            $dockingStation,
            $dockingStation2
        ]);
    }
}
