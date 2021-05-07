<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Game21Controller;
use App\Http\Controllers\YatzyController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layout.page',
//     [
//         'title' => 'Home',
//         'header' => "Home",
//         'message' => "This is the index page."
//     ]
// );
// });

Route::get('/', [IndexController::class, 'index']);

Route::get('/session', [SessionController::class, 'session']);
Route::get('/session/destroy', [SessionController::class, 'destroy']);

Route::get('/test', [TestController::class, 'test']);

Route::get('/game21/home', [Game21Controller::class, 'home']);
Route::get('/game21/destroy', [Game21Controller::class, 'destroy']);
Route::any('/game21/play', [Game21Controller::class, 'play']);
Route::get('/game21/result', [Game21Controller::class, 'result']);

Route::get('/yatzy/home', [YatzyController::class, 'home']);
Route::get('/yatzy/destroy', [YatzyController::class, 'destroy']);
Route::any('/yatzy/play', [YatzyController::class, 'play']);
Route::get('/yatzy/result', [YatzyController::class, 'result']);

Route::get('/books', [BookController::class, 'book']);


// Added for mos example code
Route::get('/hello-world', function () {
    echo "Hello World";
})->name('hello.world');
Route::get('/hello-world-view', function () {
    return view('message', [
        'message' => "Hello World from within a view"
    ]);
});
Route::get('/hello', [HelloWorldController::class, 'hello']);
Route::get('/hello/{message}', [HelloWorldController::class, 'hello']);
