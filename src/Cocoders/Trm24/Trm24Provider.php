<?php

namespace Cocoders\Trm24;

use Cocoders\CityBike\DockingStationsProvider;
use Cocoders\UseCase\AddDockingStation;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Trm24Provider implements DockingStationsProvider
{
    /** @var  \Cocoders\UseCase\AddDockingStation */
    private $addDockingStation;

    public function __construct(AddDockingStation $addDockingStation)
    {
        $this->addDockingStation = $addDockingStation;
    }

    public function getAmount()
    {
        return count($this->trm24Parser());
    }

    public function saveStations()
    {
        foreach ($this->trm24Parser() as $row) {
            $this->addDockingStation->execute(new \Cocoders\UseCase\AddDockingStationCommand(
                $row['id'],
                $row['name'],
                $row['lat'],
                $row['long']
            ));
        }
    }

    private function trm24Parser()
    {
        $client = new Client();
        $res = $client->get('https://trm24.pl/mapa_stacji.html');

        $htmlAsString = (string)$res->getBody();
        $crawler = new Crawler($htmlAsString);

        $stationsHrefs = $crawler->filter('#content > div > div > div.inside1 > div > table a');

        $stationsArray = [];

        foreach ($stationsHrefs as $station) {
            $stationHtml = $client->get($station->getAttribute('href'));

            $stationHtmlAsString = (string)$stationHtml->getBody();
            $crawler = new Crawler($stationHtmlAsString);

            $stationId = explode(
                " ",
                $crawler->filterXPath('//*[@id="content"]/div/div/div[2]/div/article/h7[1]/text()[1]')->text()) [6];

            $stationName = $crawler->
            filterXPath('//*[@id="content"]/div/div/div[2]/div/article/h7[1]/text()[2]')->text();

            $availableBikesOnStation = explode(
                " ",
                $crawler->filter('#content > div > div > div.inside1 > div > article > h7:nth-child(3)')->text()) [0];

            $stationsArray[] =
                [
                    "id" => $stationId,
                    "name" => $stationName,
                    "lat" => 0,
                    "long" => 0,
                    "availableBikes" => $availableBikesOnStation
                ];
        }

        return $stationsArray;
    }
}

