<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkAwareContext;

class ApiPublicTransportUserContext extends PublicTransportUserContext implements MinkAwareContext, Context, SnippetAcceptingContext
{
    /** @var  \Behat\Mink\Mink */
    private $mink;
    private $minkParameters;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($dockingStations)
    {
        parent::__construct();

        $this->dockingStations = $dockingStations;
    }

    public function iAmSearchingNearestBikeDockingStationsFromMyPosisitonWhichIs($positionString)
    {
        $position = \Cocoders\CityBike\Position::fromString($positionString);

        $this->mink->getSession()->visit('/nearest-stations/'.urlencode($position->getLat()).'/'.urlencode($position->getLong()));
    }

    public function iShouldSeeSuchNearestDockingStations(TableNode $table)
    {
        $this->mink->assertSession()->statusCodeEquals(200);
        $content = $this->mink->getSession()->getPage()->getContent();
        $stations = json_decode($content, true);

        if (!$stations) {
            throw new \Exception('There is no stations');
        }

        foreach ($stations as $key => $foundDockingStation) {
            if ($foundDockingStation['distance'] != $table->getHash()[$key]['distance (km)']) {
                throw new \Exception('Distance does not match');
            }
            if ($foundDockingStation['availableBikes'] != $table->getHash()[$key]['available bikes']) {
                throw new \Exception('Available does not match');
            }
            if ($foundDockingStation['lat'] != $table->getHash()[$key]['lat']) {
                throw new \Exception('lat does not match');
            }
            if ($foundDockingStation['long'] != $table->getHash()[$key]['long']) {
                throw new \Exception('long does not match');
            }
            if ($foundDockingStation['name'] != $table->getHash()[$key]['name']) {
                throw new \Exception('name does not match');
            }
        }
    }

    /**
     * Sets Mink instance.
     *
     * @param \Behat\Mink\Mink $mink Mink session manager
     */
    public function setMink(\Behat\Mink\Mink $mink)
    {
        $this->mink = $mink;
    }

    /**
     * Sets parameters provided for Mink.
     *
     * @param array $parameters
     */
    public function setMinkParameters(array $parameters)
    {
        $this->minkParameters = $parameters;
    }
}
