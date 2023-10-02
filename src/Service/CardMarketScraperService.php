<?php

namespace App\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CardMarketScraperService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function scrapeData(): Crawler
    {
        $url = 'https://www.cardmarket.com/fr/YuGiOh/Data/Weekly-Top-Cards';
        return $this->client->request('GET', $url);
    }
}