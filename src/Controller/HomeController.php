<?php

namespace App\Controller;

use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/search/{search}", name="search")
     */
    public function search(ApiTmdbService $apiTmdb, string $search): Response
    {

        
        $recherche = $apiTmdb->searchApi($search);
        // dd($recherche);
        
        return $this->render('home/search.html.twig', [
            'data' => $recherche["results"],
        ]);
    }

    /**
     * @Route("/search/id/{id}", name="searchid")
     */
    public function getMovieById(ApiTmdbService $apiTmdb, string $id): Response
    {

        $recherche = $apiTmdb->getMovieById($id);
        dd($recherche);
        
        return $this->render('home/search.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * Route vers "Save/to/BDD
     * fonction qui appelle ApiTmdbService
     * comme sur getMoviebyId on va récupérer les informations du film
     * On enregistre ces infos en BDD (travail sur l'entité)
     */

}
