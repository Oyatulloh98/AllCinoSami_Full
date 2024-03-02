<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmUzVideo;
use App\Models\Serial;
use App\Models\SerialUzVideo;

class AllCinoController extends Controller
{

    public function index()
    {
        $films = Film::paginate(8, ['*'], 'films');
        $serials = Serial::paginate(8, ['*'], 'serials');
        return view('index', ['films' => $films, 'serials' => $serials]);
    }

    public function view_film_video($id)
    {
        $uz_film_videos = FilmUzVideo::where('film_id', $id)->get();
        return view('view_film_video', compact('uz_film_videos'));
    }

    public function view_serial_video($id){
        
        $uz_serial_video = SerialUzVideo::where('serial_id', $id)->get();
        return view('view_serial_video', compact('uz_serial_video'));
    }
}







// $films = Film::join('film_uz_videos', 'films.id', '=', 'film_uz_videos.film_id')
// ->where('film_uz_videos.path', '!=', null)
// ->where('film_uz_videos.deleted_at', '=', null)
// ->get();