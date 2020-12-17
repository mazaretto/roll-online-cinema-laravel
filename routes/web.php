<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApiController;
use cijic\phpMorphy\Facade\Morphy;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::redirect('/admin', '/admin/films');

Route::get('/', function () {
  $films = \App\Models\Film::paginate(20);
  return view('roll', ['films' => $films]);
});

Route::post('/search', function (\Illuminate\Http\Request  $request) {
  $data = $request->validate([
    'query' => 'required|string',
  ]);
  $query = [];
  $morphy = new cijic\phpMorphy\Morphy('ru');

  foreach (explode(' ', $data['query']) as $item) {
    $res = $morphy->getPseudoRoot(mb_strtoupper($item));

    if ($res) {
     foreach ($res as $re) {
       $query[] = $re;
     }
    }
    $query[] = $item;
  }

  $films=\App\Models\Film::query();
  foreach($query as $word){
    $films->orWhere('title', 'LIKE', '%'.$word.'%')->orWhere('description', 'LIKE', '%'.$word.'%')
      ->orWhere('genres', 'LIKE', '%'.$word.'%')->orWhere('keys', 'LIKE', '%'.$word.'%');
  }

  $films = $films->distinct()->paginate(20);
  return view('roll', ['films' => $films, 'query' => $data['query']]);
})->name('search');

Route::get('/update', [ApiController::class, 'updateAll'])->name('update');

Route::prefix('/admin')->group(function () {
  Route::get('/', [AdminController::class, 'index'])->name('admin');
  Route::get('/films', [AdminController::class, 'films'])->name('admin.film-list');

  Route::get('/film/{id}', [AdminController::class, 'film'])->name('admin.film');
  Route::post('/film', [AdminController::class, 'filmSet'])->name('admin.film.set');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
