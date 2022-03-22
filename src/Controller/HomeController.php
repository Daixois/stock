<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Service\ApiTmdbService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'home_liste_login')]
    public function liste(MovieRepository $movieRepository, ApiTmdbService $apiTmdb):Response
    {
        return $this->render('home/index.html.twig', [
            'movie' => $movieRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'home_research')]
    public function research(ApiTmdbService $apiTmdb): Response
    {
        
        return $this->render('home/index.html.twig', [
            'home' => 'HomeController',
            
        ]);
    }
        
}
