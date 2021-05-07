<?php

declare(strict_types=1);

namespace Mack\Book;
use App\Models\Book;

/**
 * Handle data from table book.
 */
class BookHandler
{
    private $ids;
    private $titles;
    private $isbns;
    private $authors;
    private $images;

    public function getId(): array
    {
        foreach (Book::all() as $book) {
            $this->ids[] = $book->id;
        }
        return $this->ids;
    }

    public function getTitle(): array
    {
        foreach (Book::all() as $book) {
            $this->titles[] = $book->titel;
        }
        return $this->titles;
    }

    public function getISBN(): array
    {
        foreach (Book::all() as $book) {
            $this->isbns[] = $book->isbn;
        }
        return $this->isbns;
    }

    public function getAuthor(): array
    {
        foreach (Book::all() as $book) {
            $this->authors[] = $book->forfattare;
        }
        return $this->authors;
    }

    public function getImage(): array
    {
        foreach (Book::all() as $book) {
            $this->images[] = $book->bild;
        }
        return $this->images;
    }

    public function getAll(): array
    {
        foreach (Book::all() as $book) {
            $this->all[] = ["id"=>$book->id, "titel"=>$book->titel, "isbn"=> $book->isbn, "forfattare"=> $book->forfattare, "bild"=> $book->bild];
        }
        return $this->all;
    }

    public function addBook($title, $isbn, $author, $image)
    {
        Book::firstOrCreate(
            ['titel' => $title],
            ['isbn' => $isbn, 'forfattare' => $author, 'bild' => $image]
        );
    }
}
