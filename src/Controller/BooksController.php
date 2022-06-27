<?php

namespace App\Controller;

use App\Service\ApiBookService;
use App\Service\ApiTmdbService;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $search = $_GET['researchBook'];
        dd($search);
        // $request = Request::createFromGlobals();
        // $request->query->get('research');
        // dd($request);
        $searchBook = $apiBook->searchBookApi($search);
        // dd($searchBook);
        return $this->render('books/search-book.html.twig', [
            'data' => $searchBook['results'],
            'researchBook' => $searchBook,
        ]);
    }

    #[Route('/research', name: 'books_research')]
    public function researchBook(ApiBookService $apiBook): Response
    {
        return $this->render('books/research.html.twig', [
            // 'book' => $bookRepository->findAll(),
        ]);
        
    }
}