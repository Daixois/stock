<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RenderController extends AbstractController
{
    #[Route('/render', name: 'render')]
    public function index(): Response
    {
        return $this->render('render/index.html.twig', [
            'controller_name' => 'RenderController',
        ]);
    }

    public function sidebarleft(MovieRepository $movieRepository): Response
        {
            $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);

            return $this->render('partials/_sidebarleft.html.twig', [
                'lastMovie' => $lastMovie,
            ]);

        }

    public function sidebarright(ApiTmdbService $apiTmdb): Response
    {
        $research= $_GET['research'];
        
        $searchMovie = $apiTmdb->searchApi($research);
        
        return $this->render('partials/_sidebarright.html.twig', [
            'data' => $searchMovie["results"],
            'research' => $research,
        ]);
    }
}
