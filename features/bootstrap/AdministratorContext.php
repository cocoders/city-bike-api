<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Cocoders\CityBike\Position;

/**
 * Defines administrative features from the specific context.
 */
class AdministratorContext implements Context, SnippetAcceptingContext
{
    /** @var \Cocoders\CityBike\DockingStations */
    private $dockingStations;
    /** @var  \Cocoders\UseCase\AddDockingStation */
    private $addDockingStation;

    public function __construct()
    {
        $this->dockingStations = new \Cocoders\InMemory\CityBike\DockingStations();
        $this->addDockingStation = new \Cocoders\UseCase\AddDockingStation($this->dockingStations);
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
            $this->addDockingStation->execute(new \Cocoders\UseCase\AddDockingStationCommand($row['name'], $row['lat'], $row['long']));
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
}

