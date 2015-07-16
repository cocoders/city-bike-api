<?php

namespace Cocoders\File\CityBike;


use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use Everzet\PersistedObjects\AccessorObjectIdentifier;
use Everzet\PersistedObjects\FileRepository;

class DockingStationsFileRepo implements DockingStations
{

    private $stationsRepo;

    /**
     *
     */
    public function __construct()
    {
        $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'Stations';
        $this->stationsRepo = new FileRepository($file, new AccessorObjectIdentifier('getName'));
    }

    /**
     * @param DockingStation $dockingStation
     */
    public function add(DockingStation $dockingStation)
    {
        $this->stationsRepo->save($dockingStation);
    }

    /**
     * @return DockingStation[]
     */
    public function findAll()
    {
        return $this->stationsRepo->getAll();
    }


}