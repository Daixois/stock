<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;



#[Route('/genre')]
class GenreController extends AbstractController
{
    #[Route('/', name: 'genre_home')]
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'genre' => 'GenreController',
        ]);
    }

    #[Route('/search/name/{name}', name: 'genre_search')]
    public function getGenre(GenreRepository $genreRepository, ApiTmdbService $apiTmdb, string $name): Response
    {

        $allGenre = $apiTmdb->getAllGenre($name);
        // dd($allGenre);
        return $this->render('genre/index.html.twig', [
            'genresApi' => $allGenre["genres"],
            'genre' => $genreRepository->findAll(),
        ]);
    }

    #[Route('/add/allgenre', name: 'genre_addAllGenre')]
     public function addAllGenre(ApiTmdbService $apiTmdb, ManagerRegistry $doctrine, GenreRepository $genreRepo): Response
     {
        
            $allGenre = $apiTmdb->getAllGenre();
            foreach ($allGenre["genres"] as $genre) {
                $genreExist = $genreRepo->findBy(['tmdbID' => $genre["id"]]);
                if (count($genreExist) === 0) {
                    $genreEntity = new Genre();
                    $genreEntity
                        ->setName($genre["name"])
                        ->setTmdbID($genre["id"])    
                    ;

                    $em = $doctrine->getManager();
                    $em->persist($genreEntity);
                    $em->flush();
                }
            }
            
            return $this->redirectToRoute('home');
        
     }
     
    #[Route('add/genre/{id}', name: 'genre_addgenre')]
    public function addGenre(ApiTmdbService $apiTmdb, int $id, ManagerRegistry $doctrine, GenreRepository $genreRepo): Response
    {
   
        $genreExist = $genreRepo->findBy(['tmdbID' => $id]);

       
        if (count($genreExist) === 0) {
            $allGenre = $apiTmdb->getAllGenre();      
        //    dd($allGenre["genres"]);
            $genre = new Genre();
            $genre
                ->setName($allGenre["genres"]["name"])
                ->setTmdbID($allGenre["genres"]["id"])    
            ;

            $em = $doctrine->getManager();
            $em->persist($genre);
            $em->flush();
          }
        return $this->redirectToRoute('genre_search', ['id' => $id]);
    }
}
