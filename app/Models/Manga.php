<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'synopsis', 'author', 'genre', 'volumes', 'chapters', 'status', 'rating', 'start_date', 'end_date', 'cover_image'];
}
