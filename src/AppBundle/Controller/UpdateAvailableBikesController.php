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
        $stations = $this->parseDockingStations();

        foreach ($stations as $station) {
            $this->updateAvailableBikes()->execute(new Command(
                $station['id'],
                $station['availableBikes']), $this);
        }
        return $this->response;
    }

    public function updatedAvailableBikesOnStations(Response $response)
    {
        $this->getFlashMessage(
            'notice',
            ['Available bikes successfully refreshed!']
        );

        $this->response = $this->redirectToRoute('form');
    }

    public function invalidDockingStation(Response $response)
    {
        $this->getFlashMessage(
            'notice',
            ['Available bikes NOT refreshed! Please review docking station repository.']
        );

        $this->response = $this->redirectToRoute('form');
    }

    private function parseDockingStations()
    {
        return $this->get('cocoders.trm24.parser')->getDockingStations();
    }

    private function updateAvailableBikes()
    {
        return $this->get('cocoders.use_case.update_available_bikes');
    }

    private function getFlashMessage($type, $message)
    {
        return $this->container->get('session')->getFlashBag()->set(
            $type,
            $message
        );
    }
}
