<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines administrative features from the specific context.
 */
class AdministratorContext implements Context, SnippetAcceptingContext
{
    /**
     * @Given There are no docking stations
     */
    public function thereAreNoDockingStations()
    {
        throw new PendingException();
    }

    /**
     * @When I am adding new docking station:
     */
    public function iAmAddingNewDockingStation(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then docking station :arg1 should be available for public transport users using the system
     */
    public function dockingStationShouldBeAvailableForPublicTransportUsersUsingTheSystem($arg1)
    {
        throw new PendingException();
    }
}

