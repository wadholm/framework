<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display the book page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function book()
    {
        $book = new Book();

        $title = "Winnie-the-Pooh";
        $isbn = "9780525555315";
        $author = "A.A. Milne";
        $image = "/../resources/img/pooh.jpg";

        $book->addBook($title, $isbn, $author, $image);

        $title = "The Hound of the Baskervilles";
        $isbn = "9780241952870";
        $author = "Arthur Conan Doyle";
        $image = "/../resources/img/sherlock.jpg";

        $book->addBook($title, $isbn, $author, $image);

        $title = "Frankenstein";
        $isbn = "9789176451977";
        $author = "Mary Shelley";
        $image = "/../resources/img/frankenstein.jpg";

        $book->addBook($title, $isbn, $author, $image);

        $result = $book->getAll();

        return view('layout.book', [
            'title' => 'Books',
            'header' => 'Books',
            'message' => "Presenting books in the database.",
            'result' => $result
        ]);
    }
}
