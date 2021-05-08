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

    private $all;
    public $table = 'book';

    public function getAll(): array
    {
        foreach (self::all() as $book) {
            $this->all[] = ["id" => $book->id, "titel" => $book->titel, "isbn" => $book->isbn, "forfattare" => $book->forfattare, "bild" => $book->bild];
        }
        return $this->all;
    }
}
