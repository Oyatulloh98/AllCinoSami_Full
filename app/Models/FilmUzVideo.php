<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmUzVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function film_for_uz_film(){
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function uz_film_path(){
        return asset('') . 'storage/uz_film_videos/';
    }

}
