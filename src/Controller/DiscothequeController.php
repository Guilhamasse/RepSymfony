<?php

namespace App\Controller;

use App\Entity\Chanson;
use App\Repository\ArtisteRepository;
use App\Repository\ChansonRepository;
use App\Repository\TypeRepository;
use Doctrine\DBAL\Types\TypeRegistry;
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

    #[Route('/chanson/{id}', name: 'app_single_chanson')]
    public function show(Chanson $chanson): Response
    {
        //$chanson = $repoChanson->findOneBy();
        

        return $this->render('chanson/single.html.twig', [
            'chanson' => $chanson
          
        ]);
    }

    #[Route('/type/artiste/{id}', name: 'app_artistes_by_genre')]
    public function typeChoisi(TypeRepository $repoType, ChansonRepository $repoChanson, int $id): Response
    {
        $type = $repoType->find($id);
        $types = $repoType->findAll();
        $chansons = $repoChanson->findAll();
        $artistes = [];
        if (isset($type)) {
            $artistes = $type->getArtiste();
        }
        

        return $this->render('discotheque/artistes_by_genre.html.twig', [
            'type' => $type,
            'types' => $types,
            'artistes' => $artistes,
            'chansons' => $chansons
          
        ]);
    }

    #[Route('/artiste/{id}',  name: 'app_single_artiste')]
    public function singleArtiste(ArtisteRepository $repoArtiste, TypeRepository $repoType, int $id): Response
    {
        $artiste = $repoArtiste->find($id);
        $types = $repoType->findAll();

        return $this->render('artiste/single.html.twig', ['artiste' => $artiste, 'types' => $types]);
    }
}
