<?php

namespace Cocoders\File\CityBike;

use Cocoders\CityBike\DockingStation;
use Cocoders\CityBike\DockingStations;
use Everzet\PersistedObjects\AccessorObjectIdentifier;
use Everzet\PersistedObjects\FileRepository;

class DockingStationsFileRepository implements DockingStations
{

    private $stationsRepo;

    public function __construct()
    {
        $file = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'Stations';
        $this->stationsRepo = new FileRepository($file, new AccessorObjectIdentifier('getId'));
    }

    /**
     * @param DockingStation $dockingStation
     */
    public function add(DockingStation $dockingStation)
    {
        if ($this->stationsRepo->findById($dockingStation->getId())) {
            $this->stationsRepo->remove($dockingStation);
        }

        $this->stationsRepo->save($dockingStation);
    }

    /**
     * @return DockingStation[]
     */
    public function findAll()
    {
        return $this->stationsRepo->getAll();
    }

    /**
     * @return DockingStation
     */
    public function find($id)
    {
        return $this->stationsRepo->findById($id);
    }

    public function removeAll()
    {
        $this->stationsRepo->clear();
    }
}
