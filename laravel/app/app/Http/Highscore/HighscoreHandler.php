<?php

declare(strict_types=1);

namespace Mack\Highscore;

use App\Models\Highscore;

/**
 * Handle data from table highscore.
 *
 */
class HighscoreHandler
{
    public function addHighscore($name, $score)
    {
        // Validate the request..
        $hscore = new Highscore();
        $hscore->name = $name;
        $hscore->score = $score;

        $hscore->save();
    }
}
