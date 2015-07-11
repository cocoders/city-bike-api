<?php

namespace spec\Cocoders\InMemory\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\Position;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FoundDockingStationsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Cocoders\CityBike\FoundDockingStations');
    }

    function it_returns_found_docking_stations_ordered_by_distance(
        DockingStation $dockingStation1,
        DockingStation $dockingStation2,
        DockingStation $dockingStation3
    ) {
        $dockingStation1->getName()->willReturn('station 1');
        $dockingStation1->getAvailableBikes()->willReturn(1);
        $dockingStation1->getPosition()->willReturn(
            new Position(53.010418, 18.6037566)
        );
        $dockingStation2->getName()->willReturn('station 2');
        $dockingStation2->getAvailableBikes()->willReturn(1);
        $dockingStation2->getPosition()->willReturn(
            new Position(53.0132672, 18.613699)
        );
        $dockingStation3->getName()->willReturn('station 3');
        $dockingStation3->getAvailableBikes()->willReturn(1);
        $dockingStation3->getPosition()->willReturn(
            new Position(53.0099343, 18.6010726)
        );

        $foundDockingStations = $this->search(
            new Position(53.03531, 18.598338),
            [
                $dockingStation1,
                $dockingStation2,
                $dockingStation3
            ]
        );
        $foundDockingStations[0]->name->shouldBe('station 2');
        $foundDockingStations[0]->distance->shouldBe(2.66);
        $foundDockingStations[1]->name->shouldBe('station 1');
        $foundDockingStations[1]->distance->shouldBe(2.79);
        $foundDockingStations[2]->name->shouldBe('station 3');
        $foundDockingStations[2]->distance->shouldBe(2.83);
    }
}
