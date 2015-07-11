<?php

namespace Cocoders\CityBike;

final class Position
{
    private $lat;
    private $long;

    public static function fromString($string)
    {
        $string = trim($string);

        $positionArray = sscanf($string, '%f,%f');

        array_unique($positionArray);

        if ($positionArray) {
            return new static($positionArray[0], $positionArray[1]);
        }

        throw new \InvalidArgumentException(sprintf('%s is invalid lat,long string', $string));
    }

    public function __construct($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLong()
    {
        return $this->long;
    }

    /**
     * Returns distance in km between positions
     *
     * @param Position $position
     * @return float
     */
    public function calculateDistance(Position $position)
    {
        $theta = $this->long - $position->getLong();
        $distance =
            (sin(deg2rad($this->lat)) * sin(deg2rad($position->getLat()))) +
            (cos(deg2rad($this->lat)) * cos(deg2rad($position->getLat())) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);


        return round(($distance * 60 * 1.1515) * 1.609344, 2);
    }
}
