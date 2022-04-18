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
        $user = $this->getUser();
        $userCollection = $collectionsRepository->findBy(['User' =>$user]);
        // dd($userCollection);
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

            $collection->setUser($this->getUser());

            $entityManager->persist($collection);
            $entityManager->flush();

            return $this->redirectToRoute('collections_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collections/new.html.twig', [
            'collection' => $collection,
            'form' => $form,
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
