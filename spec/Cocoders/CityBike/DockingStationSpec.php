<?php

namespace spec\Cocoders\CityBike;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DockingStationSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'Toruń Rynek Staromiejski',
            new \Cocoders\CityBike\Position(
                '53.010418',
                '18.6037566'
            )
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Cocoders\CityBike\DockingStation');
    }

    function it_allows_to_get_name()
    {
        $this->getName()->shouldBe('Toruń Rynek Staromiejski');
    }

    function it_allows_to_get_position()
    {
        $this->getPosition()->shouldBeLike(
            new \Cocoders\CityBike\Position(
                '53.010418',
                '18.6037566'
            )
        );
    }

    function it_allows_set_available_bikes()
    {
        $this->setAvailableBikes(5);

        $this->getAvailableBikes()->shouldBe(5);
    }

    function it_should_have_0_available_bikes_by_default()
    {
        $this->getAvailableBikes()->shouldBe(0);
    }
}
