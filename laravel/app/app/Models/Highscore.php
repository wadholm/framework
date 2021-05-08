<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Highscore
 *
 * @property int $id
 * @property string $name
 * @property int $score
 * @method static Highscore max($score)
 * @method static Highscore orderBy('score', 'desc')
 */
class Highscore extends Model
{
    use HasFactory;

    private $highscore;
    public $table = 'highscore';
    protected $guarded = [];

    /**
     *
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function presentHighscore()
    {
        $this->result = self::orderBy('score', 'desc')->limit(10)->get();
        return $this->result;
    }

    public function getHighscore()
    {
        $this->highscore = self::max('score');

        return $this->highscore;
    }
}
