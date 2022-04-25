<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\User;
use App\Form\SearchFormType;
use App\Repository\CollectionsRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Service\ApiTmdbService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/home')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
   
    public function index(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, CollectionsRepository $collectionsRepository, GenreRepository $genreRepository, UserRepository $userRepository, Request $request): Response
    {
        
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        // dd($data);
        $moviesSearch = $movieRepository->findSearchMovie($data);

        $users = $this->getUser();
        $collections = $collectionsRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
            'movies' =>$moviesSearch,
            'movie' => $movieRepository->findAll(),
            'users' => $users,
            'collections' => $collections,
            'genre' => $genreRepository->findAll(),
            'home' => 'HomeController',
        ]);
    }


    #[Route('/research', name: 'home_research')]
    public function research(ApiTmdbService $apiTmdb): Response
    {
        
        return $this->render('home/index.html.twig', [
            'home' => 'HomeController',
            
        ]);
    }
  
     
}
