<?php

namespace AppBundle\Controller;

use Cocoders\CityBike\Position;
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
        $foundDockingStations = $this->get('cocoders.found_docking_stations')
            ->search(new Position($lat, $long));

        return new JsonResponse($foundDockingStations);
    }
}
