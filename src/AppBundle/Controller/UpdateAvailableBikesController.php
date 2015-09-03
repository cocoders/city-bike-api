<?php

namespace AppBundle\Controller;

use AppBundle\Command\UpdateAvailableBikesFromProviderCommand;
use Cocoders\CityBike\DockingStationsProvider;
use Cocoders\UseCase\UpdateAvailableBikes\Command;
use Cocoders\UseCase\UpdateAvailableBikes\Responder;
use Cocoders\UseCase\UpdateAvailableBikes\Response;
use Cocoders\UseCase\UpdateAvailableBikes\UpdateAvailableBikes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UpdateAvailableBikesController extends Controller implements Responder
{
    private $response;

    /**
     * @Route("/app/refresh", name="refresh_stations")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAvailableBikesAction()
    {
        $stations = $this->get('cocoders.trm24.parser')->getDockingStations();

        foreach ($stations as $station) {
            $this->get('cocoders.use_case.update_available_bikes')->execute(new Command(
                $station['id'],
                $station['availableBikes']), $this);
        }
        return $this->response;
    }

    public function updatedAvailableBikesOnStations(Response $response)
    {
        $this->addFlash(
            'notice',
            'Available bikes successfully refreshed!'
        );

        $this->response = $this->redirectToRoute('form');
    }

    public function invalidDockingStation(Response $response)
    {
        $this->addFlash(
            'notice',
            'Available bikes NOT refreshed! Please review docking station repository.'
        );

        $this->response = $this->redirectToRoute('form');
    }
}
