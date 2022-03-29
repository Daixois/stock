<?php

namespace App\Controller;

use App\Repository\CollectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CollectionsController extends AbstractController
{
    #[Route('/collections/liste', name: 'collections_liste')]
    public function index(CollectionsRepository $collectionsRepository): Response
    {
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'collections' => $collectionsRepository->findAll(),
        ]);
    }
}
