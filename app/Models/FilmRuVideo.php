<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmRuVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category_for_ru_film()
    {
        $this->belongsTo(Category::class);
    }

    public function brand_for_ru_film()
    {
        $this->belongsTo(Brand::class);
    }

    public function film_for_ru_film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }

    public function ru_film_path()
    {
        return asset('') . 'storage/ru_film_videos/';
    }
}
