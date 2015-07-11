<?php

namespace spec\Cocoders\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\Position;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FoundDockingStationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Cocoders\CityBike\FoundDockingStation');
    }

    function it_can_be_created_from_docking_station_object_and_distance(
        DockingStation $dockingStation
    )
    {
        $dockingStation->getName()->willReturn('My docking station');
        $dockingStation->getPosition()->willReturn(
            new \Cocoders\CityBike\Position(
                '53.010418',
                '18.6037566'
            )
        );
        $dockingStation->getAvailableBikes()->willReturn(5);

        $this->beConstructedThrough('fromDockingStationAndDistance', [$dockingStation, 3]);

        $this->name->shouldBe('My docking station');
        $this->lat->shouldBe('53.010418');
        $this->long->shouldBe('18.6037566');
        $this->availableBikes->shouldBe(5);
        $this->distance->shouldBe(3);
    }
}
