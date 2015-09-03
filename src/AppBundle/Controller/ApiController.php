<?php

namespace AppBundle\Controller;

use Cocoders\CityBike\Position;
use Cocoders\InMemory\CityBike\FoundDockingStations;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    /**
     * @Route("/nearest-stations/{lat}/{long}", name="nearest-stations-api")
     */
    public function indexAction($lat, $long)
    {
        $dockingStationsService = new FoundDockingStations();

        $foundDockingStations = $dockingStationsService
            ->search(new Position($lat, $long), $this->get('cocoders.repository.docking_station')->findAll());

        return new JsonResponse($foundDockingStations);
    }
}
