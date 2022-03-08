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

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/search/{search}", name="home_search")
     */
    public function search(ApiTmdbService $apiTmdb, string $search): Response
    {

        
        $recherche = $apiTmdb->searchApi($search);
        // dd($recherche);
        
        return $this->render('movie/search-movie.html.twig', [
            'data' => $recherche["results"],
        ]);
    }

    /**
     * @Route("/search/id/{id}", name="home_searchid")
     */
    public function getMovieById(ApiTmdbService $apiTmdb, string $id): Response
    {

        $recherche = $apiTmdb->getMovieById($id);      
        // dd($recherche);

        return $this->render('movie/get-movie.html.twig', [
            'movie' => $recherche,
        ]);
    }

    /**
     * @Route("/add/{id<\d+>}", name="home_addid")
     */
    public function addMovie(ApiTmdbService $apiTmdb, string $id, ManagerRegistry $doctrine, MovieRepository $movieRepo): Response
    {
    
        $movieExist = $movieRepo->findBy(['tmdbId' => $id]);

        //  If movie doesn't exist in the BDD
        //  Create new movie with following info
        //  Manage, persist and flush the datas
        //TODO Repeter if exists pour genres; verifier que count ===0 si il existe pas genre = new Genre idtmdb et name
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
        return $this->redirectToRoute('home_searchid', ['id' => $id]);
    }

    /**
     * @Route("/add/genre/{id}", name="home_addgenre")
     */
     public function addGenre(ApiTmdbService $apiTmdb, int $id, ManagerRegistry $doctrine, GenreRepository $genreRepo): Response
     {
    
         $genreExist = $genreRepo->findBy(['tmdbID' => $id]);

        
         if (count($genreExist) === 0) {
             $allGenre = $apiTmdb->getAllGenre();      
            dd($allGenre["genres"]);
             $genre = new Genre();
             $genre
                 ->setName($allGenre["genres"]["name"])
                 ->setTmdbID($allGenre["genres"]["id"])    
             ;

             $em = $doctrine->getManager();
             $em->persist($genre);
             $em->flush();
           }
         return $this->redirectToRoute('genre_search', ['id' => $id]);
     }
    /**
     * Route vers "Save/to/BDD
     * fonction qui appelle ApiTmdbService
     * comme sur getMoviebyId on va récupérer les informations du film
     * On enregistre ces infos en BDD (travail sur l'entité)
     */

    #[Route('/add/allgenre', name: 'home_addAllGenre')]
     public function addAllGenre(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine, GenreRepository $genreRepo): Response
     {
        
            $allGenre = $apiTmdb->getAllGenre();
            foreach ($allGenre["genres"] as $genre) {
                $genreExist = $genreRepo->findBy(['tmdbID' => $genre["id"]]);
                if (count($genreExist) === 0) {
                    $genreEntity = new Genre();
                    $genreEntity
                        ->setName($genre["name"])
                        ->setTmdbID($genre["id"])    
                    ;

                    $em = $doctrine->getManager();
                    $em->persist($genreEntity);
                    $em->flush();
                }
            }
            
            return $this->redirectToRoute('home');
        
     }
}
