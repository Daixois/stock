<?php

namespace App\Controller;

use App\Entity\Actors;
use App\Service\ApiTmdbService;
use App\Repository\ActorsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/actors', name: 'actors')]
class ActorsController extends AbstractController
{
    #[Route('/liste', name: 'actors_liste')]
    public function index(): Response
    {
        return $this->render('actors/index.html.twig', [
            'controller_name' => 'ActorsController',
        ]);
    }

    #[Route('/search/name/{name}', name: 'actors_search')]
    public function getActors(ActorsRepository $actorsRepository, ApiTmdbService $apiTmdb, string $name): Response
    {

        $allActors = $apiTmdb->getAllActors($name);
        // dd($allActors);
        return $this->render('actors/index.html.twig', [
            'actorsApi' => $allActors["actors"],
            'actor' => $actorsRepository->findAll(),
        ]);
    }

    #[Route('/add/allActors', name: 'Actors_addAllActors')]
     public function addAllActors(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine, ActorsRepository $actorsRepo): Response
     {
        
            $allActors = $apiTmdb->getAllActors();
            foreach ($allActors["actors"] as $actors) {
                $actorsExist = $actorsRepo->findBy(['tmdbID' => $actors["id"]]);
                if (count($actorsExist) === 0) {
                    $actorsEntity = new Actors();
                    $actorsEntity
                        ->setName($actors["name"])
                        ->setFirstName($actors["first_name"])
                        ->setTmdbID($actors["id"])    
                    ;

                    $em = $doctrine->getManager();
                    $em->persist($actorsEntity);
                    $em->flush();
                }
            }
            
            return $this->redirectToRoute('home');
        
     }
     
    #[Route('add/actors/{id}', name: 'Actors_addActors')]
    public function addActors(ApiTmdbService $apiTmdb, int $id, ManagerRegistry $doctrine, ActorsRepository $actorsRepo): Response
    {
   
        $actorsExist = $actorsRepo->findBy(['tmdbID' => $id]);

       
        if (count($actorsExist) === 0) {
            $allActors = $apiTmdb->getAllActors();      
        //    dd($allActors["Actorss"]);
            $actors = new Actors();
            $actors
                ->setName($allActors["actors"]["name"])
                ->setTmdbID($allActors["actors"]["id"])    
            ;

            $em = $doctrine->getManager();
            $em->persist($actors);
            $em->flush();
          }
        return $this->redirectToRoute('actors_search', ['id' => $id]);
    }
}


