<?php

namespace App\Controller;

use App\Repository\CollectionsRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CollectionsController extends AbstractController
{
    #[Route('/collections/liste', name: 'collections_liste')]
    public function index(CollectionsRepository $collectionsRepository, MovieRepository $movieRepository): Response
    {
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);

        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'collections' => $collectionsRepository->findAll(),
            'lastMovie' => $lastMovie,
        ]);
    }
}
