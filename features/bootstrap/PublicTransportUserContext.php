<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Cocoders\CityBike\FoundDockingStation;
use Cocoders\CityBike\Position;

/**
 * Defines application features from the specific context.
 */
class PublicTransportUserContext implements Context, SnippetAcceptingContext
{
    /** @var \Cocoders\CityBike\DockingStations  */
    private $dockingStations;
    private $foundDockingStations;
    /**
     * @var FoundDockingStation[]
     */
    private $nearestDockingStations = [];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->dockingStations = new \Cocoders\InMemory\CityBike\DockingStations();
        $this->foundDockingStations = new \Cocoders\InMemory\CityBike\FoundDockingStations();
    }

    /**
     * @Given there are such docking stations:
     */
    public function thereAreSuchDockingStations(TableNode $table)
    {
        foreach ($table->getHash() as $row) {
            $dockingStation = new \Cocoders\CityBike\DockingStation(
                $row['id'],
                $row['name'],
                new Position(
                    $row['lat'],
                    $row['long']
                )
            );
            $dockingStation->setAvailableBikes($row['available bikes']);
            $this->dockingStations->add($dockingStation);
        }
    }

    /**
     * @When I am searching nearest bike docking stations from my posisiton which is :positionString
     */
    public function iAmSearchingNearestBikeDockingStationsFromMyPosisitonWhichIs($positionString)
    {
        $dockingStations = $this->dockingStations->findAll();
        $this->nearestDockingStations = $this
            ->foundDockingStations
            ->search(Position::fromString($positionString), $dockingStations)
        ;
    }

    /**
     * @Then I should see such nearest docking stations:
     */
    public function iShouldSeeSuchNearestDockingStations(TableNode $table)
    {
        foreach ($this->nearestDockingStations as $key => $foundDockingStation) {
            if ($foundDockingStation->distance != $table->getHash()[$key]['distance (km)']) {
                throw new \Exception('Distance does not match');
            }
            if ($foundDockingStation->availableBikes != $table->getHash()[$key]['available bikes']) {
                throw new \Exception('Available does not match');
            }
            if ($foundDockingStation->lat != $table->getHash()[$key]['lat']) {
                throw new \Exception('lat does not match');
            }
            if ($foundDockingStation->long != $table->getHash()[$key]['long']) {
                throw new \Exception('long does not match');
            }
            if ($foundDockingStation->name != $table->getHash()[$key]['name']) {
                throw new \Exception('name does not match');
            }
        }
    }
}
