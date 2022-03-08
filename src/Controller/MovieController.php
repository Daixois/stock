<?php

namespace App\Controller;

use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/movie")
 */
class MovieController extends AbstractController
{
    
    #[Route('/', name: 'movie_home')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'movie' => 'MovieController',
        ]);
    }

 
    #[Route('/search', name: 'movie_search')]
    public function search(ApiTmdbService $apiTmdb): Response
    {

        
        $search = $apiTmdb->searchApi('spiderman');
        // dd($search);
        
        return $this->render('movie/search-movie.html.twig', [
            'data' => $search["results"],
        ]);
    }

     
    #[Route('/search/{search}', name: 'movie_search')]
    public function searchMovie(ApiTmdbService $apiTmdb, string $search): Response
    {

        
        $searchMovie = $apiTmdb->searchApi($search);
        // dd($searchMovie);
        
        return $this->render('movie/search-movie.html.twig', [
            'data' => $searchMovie["results"],
        ]);
    }
    
    #[Route('/search/id/{is}', name: 'movie_getbyid')]
    public function getMovieById(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, int $id): Response
    {

        
        $searchMovieId = $apiTmdb->getMovieById($id);
        // dd($searchMovieId);
        
        return $this->render('movie/search-movie.html.twig', [
            'data' => $apiTmdb->getMovieById($id),
            'movie' => $movieRepository->findAll(),
        ]);
    }

   
    #[Route('/search/title/{title}', name: 'movie_getbytitle')]
    public function getMovieByTitle(ApiTmdbService $apiTmdb, string $title): Response
    {

        
        $searchTitle = $apiTmdb->getMovieByTitle($title);
        // dd($searchTitle);
        
        return $this->render('movie/search.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    
    #[Route('/liste', name: 'movie_liste')]
    public function liste(MovieRepository $movieRepository, ApiTmdbService $apiTmdb):Response
    {
        return $this->render('movie/index.html.twig', [
            'movie' => $movieRepository->findAll(),
        ]);
    }
  
    #[Route('add/add/{id<\d+>}', name: 'movie_addid')]
    public function addMovie(ApiTmdbService $apiTmdb, string $id, ManagerRegistry $doctrine, MovieRepository $movieRepo): Response
    {
    
        $movieExist = $movieRepo->findBy(['tmdbId' => $id]);

        //  If movie doesn't exist in the BDD
        //  Create new movie with following info
        //  Manage, persist and flush the datas
       
        // TODO boucle for each movie  pour les genres.. Many to many setter autant que possible
            if (count($movieExist) === 0) {
                $recherche = $apiTmdb->getMovieById($id);      
                // dd($recherche["genres"]);
                $movie = new Movie();
                $movie
                    ->setTitle($recherche["title"])
                    ->setOriginalTitle($recherche["original_title"])
                    ->setPosterPath($recherche["poster_path"])
                    ->setOverview($recherche["overview"])
                    ->setTmdbId($recherche["id"])
                    ->setImdbId($recherche["imdb_id"])
                    ->setReleaseDate(DateTime::createFromFormat('Y-m-d', $recherche["release_date"]))
                ;

                $em = $doctrine->getManager();
                $em->persist($movie);
                $em->flush();
          }
        return $this->redirectToRoute('movie_searchid', ['id' => $id]);
    }

   
}
