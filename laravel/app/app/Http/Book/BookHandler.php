<?php

declare(strict_types=1);

namespace Mack\Book;

use App\Models\Book;

/**
 * Mack\Book
 *
 * @property array $all
 */
class BookHandler
{
    // private $titles;

    // public function getAll(): array
    // {
    //     foreach (Book::all() as $book) {
    //         $this->all[] = ["id" => $book->id, "titel" => $book->titel, "isbn" => $book->isbn, "forfattare" => $book->forfattare, "bild" => $book->bild];
    //     }
    //     return $this->all;
    // }

    public function addBook($title, $isbn, $author, $image)
    {
        $book = new Book();

        $book->titel = $title;
        $book->isbn = $isbn;
        $book->forfattare = $author;
        $book->bild = $image;

        $book->save();
    }
}
