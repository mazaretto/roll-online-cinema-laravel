<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','description','genres','alias_start','alias_chill','alias_ivi','alias_megogo', 'keys'];
}
