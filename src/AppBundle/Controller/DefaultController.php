<?php

namespace AppBundle\Controller;

use Cocoders\UseCase\AddDockingStation\Responder;
use Cocoders\UseCase\AddDockingStation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CityBike\AddDockingStationForm;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller implements Responder
    {
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/app/form", name="form")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function formAction(Request $request)
    {
        $form = $this->createForm(new AddDockingStationForm());

        $form->handleRequest($request);

        $stations = $this->get('cocoders.repository.docking_station')->findAll();

        if ($form->isValid()) {
            $this->get('cocoders.use_case.add_docking_station')->execute($form->getData(), $this);
        }

        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(),
            'stations' => $stations));
    }

    public function addedDockingStation(Response $response)
    {
        // TODO later: Implement addedDockingStation() method.
    }
}
