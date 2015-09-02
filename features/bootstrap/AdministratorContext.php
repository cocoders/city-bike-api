<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines administrative features from the specific context.
 */
class AdministratorContext implements Context, SnippetAcceptingContext, \Cocoders\UseCase\AddDockingStation\Responder
{
    /** @var \Cocoders\CityBike\DockingStations */
    private $dockingStations;
    /** @var  \Cocoders\UseCase\AddDockingStation\AddDockingStation */
    private $addDockingStation;

    public function __construct()
    {
        $this->dockingStations = new \Cocoders\InMemory\CityBike\DockingStations();
        $this->addDockingStation = new \Cocoders\UseCase\AddDockingStation\AddDockingStation($this->dockingStations);
    }

    /**
     * @Given There are no docking stations
     */
    public function thereAreNoDockingStations()
    {

    }

    /**
     * @When I am adding new docking station:
     */
    public function iAmAddingNewDockingStation(TableNode $table)
    {
        foreach ($table->getHash() as $row) {
            $this->addDockingStation->execute(new \Cocoders\UseCase\AddDockingStation\Command(
                $row['id'],
                $row['name'],
                $row['lat'],
                $row['long']
            ), $this);
        }
    }

    /**
     * @Then docking station :arg1 should be available for public transport users using the system
     */
    public function dockingStationShouldBeAvailableForPublicTransportUsersUsingTheSystem($dockingStationName)
    {
        foreach ($this->dockingStations->findAll() as $specifiedDockingStation) {
            if ($dockingStationName === $specifiedDockingStation->getName()) {
                return;
            }
        }

        throw new \Exception('Docking station not found');
    }

    public function addedDockingStation(\Cocoders\UseCase\AddDockingStation\Response $response)
    {
    }
}
