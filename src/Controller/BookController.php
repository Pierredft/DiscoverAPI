<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/api/books', name: 'app_book', methods: ['GET'])]
    public function getBookList(BookRepository $bookRepository): JsonResponse
    {
        $bookList = $bookRepository->findAll();
        return new JsonResponse([
            'books' => $bookList,
        ]);
    }
}
