<?php

namespace App\Controller;

use App\Entity\Movie;
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
     * @Route("/add/{id}", name="home_addid")
     */
    public function addMovie(ApiTmdbService $apiTmdb, string $id, ManagerRegistry $doctrine, MovieRepository $movieRepo): Response
    {
    
        $movieExist = $movieRepo->findBy(['tmdbId' => $id]);

//  If movie doesn't exist in the BDD
//  Create new movie with following info
//  Manage, persist and flush the datas
        if (count($movieExist) === 0) {
            $recherche = $apiTmdb->getMovieById($id);      
            // dd($recherche);
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
        return $this->redirectToRoute('searchid', ['id' => $id]);
    }

    /**
     * Route vers "Save/to/BDD
     * fonction qui appelle ApiTmdbService
     * comme sur getMoviebyId on va récupérer les informations du film
     * On enregistre ces infos en BDD (travail sur l'entité)
     */

}
