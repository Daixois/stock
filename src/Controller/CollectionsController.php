<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Form\CollectionsType;
use App\Repository\CollectionsRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/collections')]
class CollectionsController extends AbstractController
{
    #[Route('/liste', name: 'collections_liste')]
    public function index(CollectionsRepository $collectionsRepository, MovieRepository $movieRepository): Response
    {
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);

        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'collections' => $collectionsRepository->findAll(),
            'lastMovie' => $lastMovie,
        ]);
    }

    #[Route('/new', name: 'collections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MovieRepository $movieRepository): Response
    {
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);

        $collection = new Collections();
        $form = $this->createForm(CollectionsType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($collection);
            $entityManager->flush();

            return $this->redirectToRoute('collections_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collections/new.html.twig', [
            'collection' => $collection,
            'form' => $form,
            'lastMovie' => $lastMovie,
        ]);
    }
}
