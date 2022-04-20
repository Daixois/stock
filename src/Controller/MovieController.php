<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Form\SearchFormType;
use App\Service\ApiTmdbService;
use App\Repository\UserRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/movie')]
class MovieController extends AbstractController
{
    
    #[Route('/', name: 'movie_home')]
    public function index(MovieRepository $movieRepository, ApiTmdbService $apiTmdb): Response
    {
        // $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);
        
        return $this->render('movie/index.html.twig', [
            'movie' => $movieRepository->findAll(),
            // 'lastMovie' => $lastMovie,
        ]);
    }

    #[Route('/search', name: 'movie_searchMovie')]
    public function searchMovie(ApiTmdbService $apiTmdb): Response
    {
        $search= $_GET['research'];
        
        $searchMovie = $apiTmdb->searchApi($search);
        
        return $this->render('movie/search-movie.html.twig', [
            'data' => $searchMovie["results"],
            'research' => $search,
        ]);
    }

    #[Route('/research', name: 'movie_research')]
    public function research(MovieRepository $movieRepository, ApiTmdbService $apiTmdb): Response
    {
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);
        return $this->render('movie/research.html.twig', [
            'movie' => $movieRepository->findAll(),
            'lastMovie' => $lastMovie,
            
        ]);
    }
    
    #[Route('/search/id/{id}', name: 'movie_getbyid')]
    public function getMovieById(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, int $id): Response
    { 
        $searchMovieId = $apiTmdb->getMovieById($id);
        // dd($searchMovieId);
        $movieId = json_encode($searchMovieId);
        $movieId = json_decode($movieId);
        // dd($movieId);
        return $this->render('movie/search-movie.html.twig', [
            'data' => $movieId,
            'movieAll' => $movieRepository->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'movie_getdatabaseid')]
    public function getMovieInDatabaseById(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, int $id): Response
    {
        $movie = $movieRepository->find($id);
        
        return $this->render('movie/get-movie.html.twig', [
            'movie' => $movie,
        ]);
    }    
   
    #[Route('/search/title/{title}', name: 'movie_getbytitle')]
    public function getMovieByTitle(ApiTmdbService $apiTmdb, string $title): Response
    { 
        $searchTitle = $apiTmdb->getMovieByTitle($title);
        // dd($searchTitle);
        
        return $this->render('movie/search.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    
    #[Route('/liste', name: 'movie_liste')]
    public function liste(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, UserRepository $userRepository, Request $request):Response
    {
        
        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        // dd($data);
        $moviesSearch = $movieRepository->findSearchMovie($data);
       
        $users = $this->getUser();
        return $this->render('movie/index.html.twig', [
            'movie' => $movieRepository->findAll(),
            'movies' =>$moviesSearch,
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }
//   Test pagination 
    #[Route('/liste2', name: 'movie_liste2')]
    public function liste2(MovieRepository $movieRepository, ApiTmdbService $apiTmdb, UserRepository $userRepository,GenreRepository $genreRepository):Response
    {
        $nbResult= 2;
        if (isset($_GET['limit']) && $_GET['limit'] > 0) {
            $nbResult = $_GET['limit'];
        }
        $page= 1;
        if (isset($_GET['page']) && $_GET['page'] > 0) {
            $page = $_GET['page'];
        }
        $anneeMin= null;
        if (isset($_GET['anneeMin']) && $_GET['anneeMin'] > 0) {
            $anneeMin = $_GET['anneeMin'];
        }
        $anneeMax= null;
        if (isset($_GET['anneeMax']) && $_GET['anneeMax'] > 0) {
            $anneeMax = $_GET['anneeMax'];
        }
        
        $genre = $genreRepository->find(17);
        // dd($genre);
        // $anneeMin= new \DateTime();
        // $moviesSearch = $movieRepository->findBy([], [], $nbResult, $page*$nbResult-($nbResult));
        $moviesSearch = $movieRepository->findBy([], [], $nbResult, $page*$nbResult-($nbResult));
        $users = $this->getUser();
        return $this->render('movie/index2.html.twig', [
            
            'movie' =>$moviesSearch,
            'users' => $users,
        ]);
    }
    #[Route('/add/add/{id<\d+>}', name: 'movie_addid')]
    public function addMovie(ApiTmdbService $apiTmdb, string $id, ManagerRegistry $doctrine, MovieRepository $movieRepo): Response
    {
    
        $movieExist = $movieRepo->findBy(['tmdbId' => $id]);

        //  If movie doesn't exist in the BDD
        //  Create new movie with following info
        //  Manage, persist and flush the datas
       
            if (count($movieExist) === 0) {
                $completeMovie = $apiTmdb->getMovieById($id);      
                // dd($completeMovie["genres"]);
                $movie = new Movie();
                $movie
                    ->setTitle($completeMovie["title"])
                    ->setOriginalTitle($completeMovie["original_title"])
                    ->setPosterPath($completeMovie["poster_path"])
                    ->setOverview($completeMovie["overview"])
                    ->setTmdbId($completeMovie["id"])
                    ->setImdbId($completeMovie["imdb_id"])
                    ->setReleaseDate(DateTime::createFromFormat('Y-m-d', $completeMovie["release_date"]))           
                ;

                $em = $doctrine->getManager();
                $em->persist($movie);
                $em->flush();
          }
        return $this->redirectToRoute('movie_liste', ['id' => $id]);
    }

    #[Route('/testgenre', name: 'movie_testgenre')]
    public function testGenre(MovieRepository $movieRepository, GenreRepository $genreRepository, ManagerRegistry $doctrine, ApiTmdbService $apiTmdb): Response
    {
        // Déclare doctrine
        $em = $doctrine->getManager();

        // 1. Tu récupère tes films en BDD (findAll)
        $ficheMovie = $movieRepository->findAll();

        // 2. ForEach films, 
        foreach ($ficheMovie as $movie) {
            // 2bis tu interroges TMDB pour obtenir leur genre (Service TMDB)
            $tmdbMovie = $apiTmdb->getMovieById($movie->getTmdbId());

            // 3. Pour les genres reçus (forEach), tu vérifies dans ta BDD que l'ID TMDB_Genre est ou n'est pas dans ta table Genre (findBy tmdb_id)
            foreach ($tmdbMovie['genres'] as $genreTmdb) {
                $genreBdd = $genreRepository->findOneBy(['tmdbID' => $genreTmdb['id']]);
                
                // 4. Si tu n'as pas le genre, tu rajoutes le genre (Set puis Get). Sinon, tu le(s) prend (Get)
                if ($genreBdd === null) {
                    $addGenre = new Genre();
                    $addGenre
                        ->setName($genreTmdb['name'])
                        ->setTmdbID($genreTmdb['id'])
                    ;
                    $genreBdd = $addGenre;
                    $em->persist($addGenre);
                }
                
                $movie->addGenre($genreBdd);
                $em->persist($genreBdd);
                
            }          
        }

        $em->flush();

        // dd('stop');
        
        return $this->redirectToRoute('home');
    }
   
}