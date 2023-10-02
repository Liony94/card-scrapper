<?php

namespace App\Controller;

use App\Service\EbayService;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class YuGiOhController extends AbstractController
{
    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface|GuzzleException
     */
    #[Route(path: '/', name: 'app_yugioh')]
    public function index(EbayService $ebayService): Response
    {
        $data = $ebayService->findYuGiOhCards();

        return $this->render('yu_gi_oh/index.html.twig', [
            'data' => $data,
        ]);
    }
}

