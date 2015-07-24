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

    public function __construct()
    {
        $this->dockingStations = new \Cocoders\InMemory\CityBike\DockingStations();
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
            $dockingStation = new \Cocoders\CityBike\DockingStation(
                $row['name'],
                new Position(
                    $row['lat'],
                    $row['long']
                )
            );
            $this->dockingStations->add($dockingStation);
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
