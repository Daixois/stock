<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/musics')]
class MusicsController extends AbstractController
{
    #[Route('/home', name: 'musics_home')]
    public function index(MovieRepository $movieRepository, ApiTmdbService $apiTmdb): Response
    {
        
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);
        return $this->render('musics/index.html.twig', [
            'movie' => $movieRepository->findAll(),
            'lastMovie' => $lastMovie,
        ]);
    }
}