<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;



#[Route('/genre')]
class GenreController extends AbstractController
{
    #[Route('/', name: 'genre_home')]
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'genre' => 'GenreController',
        ]);
    }

    #[Route('/search', name: 'genre_search')]
    public function getGenre(GenreRepository $genreRepository, ApiTmdbService $apiTmdb, string $name): Response
    {

        $recherche = $apiTmdb->getGenre($name);
         dd($recherche);
        return $this->render('movie/search-movie.html.twig', [
            'data' => $apiTmdb->getGenre($name),
            'genre' => $genreRepository->findAll(),
        ]);
    }
}
