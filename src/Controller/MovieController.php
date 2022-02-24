<?php

namespace App\Controller;

use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/movie", name="movie_")
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
   
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(ApiTmdbService $apiTmdb): Response
    {

        
        $recherche = $apiTmdb->searchApi('spiderman');
        // dd($recherche);
        
        return $this->render('home/search.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/search/id/{id}", name="getbyid")
     */
    public function getMovieById(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, int $id): Response
    {

        
        $recherche = $apiTmdb->getMovieById($id);
        // dd($recherche);
        
        return $this->render('movie/search.html.twig', [
            'data' => $apiTmdb->getMovieById($id),
            'movie' => $movieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/search/title/{title}", name="getbytitle")
     */
    public function getMovieByTitle(ApiTmdbService $apiTmdb, string $title): Response
    {

        
        $recherche = $apiTmdb->getMovieByTitle($title);
        // dd($recherche);
        
        return $this->render('movie/search.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    /**
     * @Route("/add", name="movie")
     */
    public function addMovie(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();

        //Add the new film to BDD
        $movie =new Movie();
       

        //Save the Movie
        $entityManager->persist($movie);
        //Insert the movie
        $entityManager->flush();
        // If succeed this message appears
        return new Response('Nouveau film ajouté'.$movie->getId());
      
    }

    /**
    * @Route("/liste", name="liste") 
    */
    public function liste(MovieRepository $movieRepository, ApiTmdbService $apiTmdb):Response
    {
        return $this->render('movie/index.html.twig', [
            'movie' => $movieRepository->findAll(),
        ]);
    }
}
