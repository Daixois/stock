<?php

namespace App\Controller;

use App\Repository\CollectionsRepository;
use App\Repository\MovieRepository;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $request = Request::createFromGlobals();
        $request->query->get('research');
        // $search= $_GET['research'];
        
        $searchMovie = $apiTmdb->searchApi($request);
        
        return $this->render('partials/_sidebarright.html.twig', [
            'data' => $searchMovie["results"],
            'research' => $request,
        ]);
    }

    public function footer(CollectionsRepository $collectionsRepository): Response
    {
        
        $collections = $collectionsRepository->findAll();
        return $this->render('partials/_footer.html.twig', [
            'collections' => $collections,
        ]);
    }
}
