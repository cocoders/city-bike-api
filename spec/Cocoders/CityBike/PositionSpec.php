<?php

namespace spec\Cocoders\CityBike;

use Cocoders\CityBike\Position;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PositionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            '53.010418',
            '18.6037566'
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Cocoders\CityBike\Position');
    }

    function it_allows_to_get_lat()
    {
        $this->getLat()->shouldBe('53.010418');
    }

    function it_allows_to_get_long()
    {
        $this->getLong()->shouldBe('18.6037566');
    }

    function it_calculate_distance_between_two_posistion()
    {
        $this
            ->calculateDistance(
                new Position(53.03531, 18.598338)
            )
            ->shouldBe(2.79);
    }

    public function it_creates_position_from_string()
    {
        $position = $this->fromString('54.010418,19.6037566');
        $position->getLat()->shouldBe(54.010418);
        $position->getLong()->shouldBe(19.6037566);

        $position = $this->fromString('54.010419,   19.6037550');
        $position->getLat()->shouldBe(54.010419);
        $position->getLong()->shouldBe(19.6037550);
    }
}
