<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmsStart;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function updateAll()
  {
    $this->updateStart();
    $this->updateChill();

    return 'Data updated';
  }

  public function updateChill()
  {
    for ($i = 0; $i < 20; $i++) {
      $data = file_get_contents("https://chillvision.ru/Public/API?action=grid&page=".$i);
      $data = json_decode($data);
      if ($data->status != 'ok') {
        dd($data);
        return;
      }
      foreach ($data->grid->items as $item) {
        $row = Film::where('title', $item->name)->first();
        $image = 'https://chillvision.ru/media/' . $item->image_context . '/' . $item->image_owner . '/' . $item->image . '.SW_400H_520CF_1.jpg';
        $link = 'https://chillvision.ru/Soap/' . $item->content_id;
        if (!$row) {
          Film::create([
            'title' => $item->name,
            'image' => $image,
            'genres' => $item->genre_name,
            'alias_chill' => $link,
          ]);
        } else {
          $row->image = $image;
          $row->genres = $item->genre_name;
          $row->alias_chill = $link;
          $row->save();
        }
      }
    }
  }

  public function updateStart()
  {
    $data = file_get_contents("https://api.start.ru/partner/meta/kinoteatr?apikey=oGe19yFTQQucbvdYE7tOPzwzV0a1S9Yb");
    $data = json_decode($data);
    foreach ($data as $item) {
      $image = null;
      if ($item->vertical->image_15x) {
        $image = $item->vertical->image_15x;
      } elseif ($item->vertical->image_1x) {
        $image = $item->vertical->image_1x;
      } elseif ($item->background->image_1x) {
        $image = $item->background->image_1x;
      }
      if ($image) {
        $image = 'https://start.ru' . $image;
      }

      $genres = [];
      foreach ($item->genres as $genre) {
        $genres[] = $genre->title;
      }

      $alias = 'https://start.ru/watch/' . $item->alias;

      $row = Film::where('title', $item->title)->first();
      if (!$row) {
        Film::create([
          'alias_start' => $alias,
          'image' => $image,
          'title' => $item->title,
          'description' => $item->description,
          'genres' => implode(', ', $genres),
        ]);
      } else {
        $row->image = $image;
        $row->description = $item->description;
        $row->genres = implode(', ', $genres);
        $row->save();
      }
    }
  }
}
