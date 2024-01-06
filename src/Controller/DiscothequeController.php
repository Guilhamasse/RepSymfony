<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use App\Repository\ChansonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscothequeController extends AbstractController
{
    #[Route('/discotheque', name: 'app_discotheque')]
    public function index(ChansonRepository $repoChanson, ArtisteRepository $repoArtiste): Response
    {
        $chansons = $repoChanson->findAll();
        $artistes = $repoArtiste->findAll();

        return $this->render('discotheque/index.html.twig', [
            'chansons' => $chansons,
            'artistes' => $artistes
        ]);
    }
}
