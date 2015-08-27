<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\CityBike\AddDockingStationForm;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
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

        $stations = $this->get('docking_station')->findAll();

        if ($form->isValid()) {
            $this->get('add_docking_station')->execute($form->getData());
        }

        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(),
            'stations' => $stations));
    }
}

