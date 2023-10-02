<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EbayService
{
    private Client $client;
    private string $appID;

    public function __construct(string $appID)
    {
        $this->client = new Client([
            'base_uri' => 'https://svcs.ebay.com/services/search/FindingService/v1',
        ]);
        $this->appID = $appID;
    }

    /**
     * @throws GuzzleException
     */
    public function findYuGiOhCards()
    {
        $response = $this->client->request('GET', '', [
            'query' => [
                'OPERATION-NAME' => 'findCompletedItems',
                'SERVICE-VERSION' => '1.0.0',
                'SECURITY-APPNAME' => $this->appID,
                'RESPONSE-DATA-FORMAT' => 'JSON',
                'REST-PAYLOAD' => null,
                'keywords' => 'Yu-Gi-Oh card',
                'paginationInput.entriesPerPage' => '10',
                'sortOrder' => 'EndTimeSoonest',
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}

