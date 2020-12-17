<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
  {
    return view('admin.dashboard');
  }

  public function films()
  {
    $films = Film::all();

    return view('admin.film-list', ['films' => $films]);
  }

  public function film($id)
  {
    return view('admin.film', ['film' => Film::find($id)]);
  }

  public function filmSet(Request $request)
  {
    $data = $request->validate([
      'id' => 'required|numeric',
      'description' => 'nullable|string',
      'genres' => 'nullable|string',
      'keys' => 'nullable|string',
    ]);

    $film = Film::find($data['id']);

    if (isset($data['description'])) {
      $film->description = $data['description'];
    }
    if (isset($data['genres'])) {
      $film->genres = $data['genres'];
    }
    if (isset($data['keys'])) {
      $film->keys = $data['keys'];
    }

    $film->save();

    return redirect()->route('admin.film', ['id' => $data['id']]);
  }
}
