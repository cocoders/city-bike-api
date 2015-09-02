<?php

namespace Cocoders\Trm24;

use Cocoders\CityBike\DockingStationsProvider;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class Trm24Provider implements DockingStationsProvider
{
    private $client;
    private $parsedLongLat;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getNumberOfDockingStations()
    {
        return count($this->getDockingStations());
    }

    public function getDockingStations()
    {
        $stations = [];
        foreach ($this->parseStationsUrls() as $url) {
            $stations[] = $this->parseStationPage($url->getAttribute('href'));
        }

        return $stations;
    }

    private function parseStationsUrls()
    {
        return $this->getTrm24Body()->filter('#content > div > div > div.inside1 > div > table a');
    }

    private function parseStationPage($url)
    {
        $html = (string)$this->client->get($url)->getBody();
        $crawler = new Crawler($html);

        $id = $this->parseStationId($crawler);
        return [
            'id' => $id,
            'name' => $this->parseStationName($crawler),
            'lat' => $this->parseLatitude($id),
            'long' => $this->parseLongitude($id),
            'availableBikes' => $this->parseAvailableBikes($crawler)
        ];
    }

    private function parseStationId(Crawler $crawler)
    {
        $stationIdText = $crawler->filterXPath('//*[@id="content"]/div/div/div[2]/div/article/h7[1]/text()[1]')->text();
        $stationIdArray = explode(" ", $stationIdText);

        if (isset($stationIdArray[6])) {
            return $stationIdArray[6];
        }

        throw new \InvalidArgumentException('Station id does not found on web page');
    }

    private function parseStationName(Crawler $crawler)
    {
        return $crawler->filterXPath('//*[@id="content"]/div/div/div[2]/div/article/h7[1]/text()[2]')->text();
    }

    private function parseAvailableBikes(Crawler $crawler)
    {
        $availableStationsText = $crawler->filterXPath('//*[@id="content"]/div/div/div[2]/div/article/h7[2]')->text();
        $availableStationsArray = explode(" ", $availableStationsText);

        if (isset($availableStationsArray[0])) {
            return $availableStationsArray[0];
        }

        throw new \InvalidArgumentException("Available stations not found");
    }

    private function getTrm24Body()
    {
        $html = (string)$this->client->get('https://trm24.pl/mapa_stacji.html')->getBody();
        return new Crawler($html);
    }

    private function parseLatLong()
    {
        if ($this->parsedLongLat) {
            return $this->parsedLongLat;
        }
        $scriptAsString = $this->getTrm24Body()->filterXPath('//*[@id="content"]/div/div/div[2]/script[2]')->text();

        preg_match_all(
            "/(?=marker)(.*)(\s=.*)([-+]?\d{2}[.]\d{2,})(.*)([-+]?\d{2}[.]\d{2,})/",
            $scriptAsString,
            $this->parsedLongLat
        );

        return $this->parsedLongLat;
    }

    private function parseLatitude($id)
    {
        return $this->parseLatLong()[3][$id - 1];
    }

    private function parseLongitude($id)
    {
        return $this->parseLatLong()[5][$id - 1];
    }
}
