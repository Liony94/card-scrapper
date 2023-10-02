<?php

namespace App\Controller;

use App\Service\CardMarketScraperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardMarketController extends AbstractController
{
    #[Route(path: '/scrape', name: 'scrape_data')]
    public function scrape(CardMarketScraperService $scraper): Response
    {
        $crawler = $scraper->scrapeData();

        $data = $crawler->filter('#tabContent-DataTable table tbody tr')->each(function ($node) {
            return [
                'image_url' => $node->filter('td span.thumbnail-icon')->attr('data-original-title'),
                'expansion' => $node->filter('td a span.expansion-symbol')->text(),
                'name' => $node->filter('td a')->last()->text(),
                'price' => $node->filter('td div.algn-r')->text(),
            ];
        });

        return $this->json($data);
    }
}