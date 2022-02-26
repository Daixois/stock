<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Repository\GenreRepository;
use App\Service\ApiTmdbService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/genre")
 */
class GenreController extends AbstractController
{
    #[Route('/home', name: 'genre')]
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    /**
     * @Route("/search", name="genre_search")
     */
    public function search(ApiTmdbService $apiTmdb): Response
    {

        
        $recherche = $apiTmdb->searchApi('comedie');
        // dd($recherche);
        
        return $this->render('genre/search.html.twig', [
            'data' => $recherche["results"],
        ]);
    }

    /**
     * @Route("/search/id/{id}", name="genre_getbyid")
     */
    public function getGenreById(GenreRepository $genreRepository, ApiTmdbService $apiTmdb, int $id): Response
    {

        
        $recherche = $apiTmdb->getGenreById($id);
        // dd($recherche);
        
        return $this->render('genre/search.html.twig', [
            'data' => $apiTmdb->getGenreById($id),
            'genre' => $genreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/search/name/{name}", name="genre_getbyname")
     */
    public function getGenreByName(ApiTmdbService $apiTmdb, string $name): Response
    {

        
        $recherche = $apiTmdb->getGenreByName($name);
        // dd($recherche);
        
        return $this->render('genre/search.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    /**
     * @Route("/add", name="genre_movie")
     */
    public function addGenre(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();

        //Add the new genre to BDD
        $genre =new Genre();
       

        //Save the Genre
        $entityManager->persist($genre);
        //Insert the genre$genre
        $entityManager->flush();
        // If succeed this message appears
        return new Response('Nouveau genre ajouté'.$genre->getId());
      
    }

    /**
    * @Route("/liste", name="genre_liste") 
    */
    public function liste(GenreRepository $genreRepository, ApiTmdbService $apiTmdb):Response
    {
        return $this->render('genre/index.html.twig', [
            'genre' => $genreRepository->findAll(),
        ]);
    }
}
