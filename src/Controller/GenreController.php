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

    #[Route('/search/name/{name}', name: 'genre_search')]
    public function getGenre(GenreRepository $genreRepository, ApiTmdbService $apiTmdb, string $name): Response
    {

        $allGenre = $apiTmdb->getAllGenre($name);
        // dd($allGenre);
        return $this->render('genre/index.html.twig', [
            'genresApi' => $allGenre["genres"],
            'genre' => $genreRepository->findAll(),
        ]);
    }
}
