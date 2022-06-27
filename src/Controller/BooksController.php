<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Service\ApiBookService;
use App\Service\ApiTmdbService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/books')]
class BooksController extends AbstractController
{
    #[Route('/home', name: 'books_home')]
    public function index(MovieRepository $movieRepository, ApiTmdbService $apiTmdb): Response
    {
        $lastMovie = $movieRepository->findBy([], ['created_at' => 'DESC'], 3);

        return $this->render('books/index.html.twig', [
            'movie' => $movieRepository->findAll(),
            'lastMovie' => $lastMovie,
        ]);
    }

    #[Route('/search', name: 'books_searchBook')]
    public function searchBook(ApiBookService $apiBook): Response
    {
        $search = $_GET['research'];

        $searchMovie = $apiBook->searchBookApi($search);

        return $this->render('books/search-book.html.twig', [
            'data' => $searchBook['results'],
            'research' => $search,
        ]);
    }

    #[Route('/research', name: 'books_research')]
    public function research(BookRepository $bookRepository, ApiBookService $apiBook): Response
    {
        return $this->render('books/research.html.twig', [
            'book' => $bookRepository->findAll(),
        ]);
    }
}