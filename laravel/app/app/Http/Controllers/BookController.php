<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mack\Book\BookHandler;


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
        $book = new BookHandler();

        // $title = "Frankenstein";
        // $isbn = "9789176451977";
        // $author = "Mary Shelley";
        // $image = "/../resources/img/pooh.jpg";

        // $book->addBook($title, $isbn, $author, $image);
        $result = $book->getAll();

        return view('layout.book', [
            'title' => 'Books',
            'header' => 'Books',
            'message' => "Presenting books in the database.",
            'result' => $result
        ]);
    }
}
