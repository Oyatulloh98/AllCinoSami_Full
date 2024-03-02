<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function film_ru_video()
    {
        return $this->hasMany(FilmRuVideo::class, 'film_id');
    }
    public function film_ru_video_path()
    {
        return asset('') . 'storage/ru_film_videos';
    }
    public function film_uz_video()
    {
        return $this->hasMany(FilmUzVideo::class, 'film_id');
    }
    public function film_uz_video_path()
    {
        return asset('') . 'storage/uz_film_videos';
    }
    public function filmImagePath()
    {
        return asset('') . 'storage/film_images/';
    }
    public function film_image()
    {
        return $this->hasMany(ImageFilm::class);
    }
}
