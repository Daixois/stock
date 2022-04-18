<?php

namespace App\Controller;

use App\Entity\Collections;
use App\Entity\User;
use App\Form\CollectionsType;
use App\Repository\CollectionsRepository;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PharIo\Manifest\Manifest;
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
        
        return $this->render('collections/index.html.twig', [
            'controller_name' => 'CollectionsController',
            'collections' => $collectionsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'collections_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MovieRepository $movieRepository): Response
    {
        
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
        ]);
    }
    // Je veux lier les collections aux utilisateurs
        #[Route('/user', name: 'collections_user')]
        public function userCollections(CollectionsRepository $collectionsRepository, UserRepository $userRepository, ManagerRegistry $doctrine): Response
        {
            // 1 j'appelle les utilisateurs de la base de données
            $user = $doctrine->getRepository(User::class)->findAll();
            //dd ($user);
            // 2 je récupère les collections de la base de données
            $collections = $doctrine->getRepository(Collections::class)->findAll();
            dd ($collections);

            // Proposé par copilot
            // 3 Je vérifie que les collections sont liées à un utilisateur
            foreach ($collections as $collection) {
                dd ($collection);
                // 4 je récupère l'id de l'utilisateur
                // $userId = $collection->getUser()->getId();
                //dd ($userId);
                // 5 je récupère l'id de l'utilisateur de la session
                // $userSession = $this->getUser()->getId();
                //dd ($userSession);
                // 6 je vérifie que l'id de l'utilisateur de la session est égal à l'id de l'utilisateur de la collection
                // if ($userId == $userSession) {
                    // 7 je récupère les collections liées à l'utilisateur
                    // $userCollections = $collection;
                    //dd ($userCollections);
                }
            // }

            return $this->render('collections/user.html.twig', [
                'controller_name' => 'CollectionsController',
                'collections' => $collectionsRepository->findAll(),
                'users' => $userRepository->findAll(),        
            ]);
        }

        // #[Route('/getUser', name: 'collections_getUser')]
        // public function getUser(UserRepository $userRepository, CollectionsRepository $collectionsRepository): Response
        // {
        //     $user = $this->getUser();
        //     $userId = $user->getId();
        //     $user = $userRepository->find($userId);
        //     return $this->render('collections/user.html.twig', [
        //         'controller_name' => 'CollectionsController',
        //         'collections' => $collectionsRepository->findAll(),
        //         'users' => $userRepository->findAll(),        
        //     ]);
        // }
    
}
