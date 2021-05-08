<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Book
 *
 * @property int $id
 * @property string $titel
 * @property string $isbn
 * @property string $forfattare
 * @property string $bild
 */
class Book extends Model
{
    use HasFactory;

    public $timestamps = false;

    private $all;
    public $table = 'book';
    protected $guarded = [];

    public function getAll(): array
    {
        foreach (self::all() as $book) {
            $this->all[] = ["id" => $book->id, "titel" => $book->titel, "isbn" => $book->isbn, "forfattare" => $book->forfattare, "bild" => $book->bild];
        }
        return $this->all;
    }

    public function addBook($title, $isbn, $author, $image)
    {
        self::firstOrCreate(
            ['titel' => $title],
            ['isbn' => $isbn, 'forfattare' => $author, 'bild' => $image]
        );
    }
}
