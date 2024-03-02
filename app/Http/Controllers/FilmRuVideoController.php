<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmRuVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Film\Film_Ru_Video\FilmRuRequest;
use App\Http\Requests\Film\Film_Ru_Video\UpdateFilmRuVideo;

class FilmRuVideoController extends Controller
{
    /**
     *  Filmni idsiga asoslanib uning videosini qayataradi
     */
    public function ru_film_index($id)
    {
        $film = Film::where('id', $id)->withTrashed()->first();
        $russian_film_videos = FilmRuVideo::withTrashed()->where('film_id', $id)->get();
        return view('dashboard.film.ru_film_video.index', compact('russian_film_videos', 'id', 'film'));
    }

    /**
     *  Filmni idsiga asoslanib uning videosini yaratadi
     */
    public function ru_film_create($id)
    {
        $ru_film = Film::where('id', $id)->first();
        return view('dashboard.film.ru_film_video.create', compact('ru_film'));
    }

    /**
     *  Bu yerda oldin krirtilgan film video qismlarini tekshiradi
     */
    public function russion_video_suitable_recipient(Request $request)
    {
        $film = FilmRuVideo::where('film_id', $request->film_id)
            ->where('part', $request->part)
            ->first();
        if ($film) {
            return response()->json([
                'error' => true
            ]);
        } else {
            return response()->json([
                'error' => false
            ]);
        }
    }

    /**
     *  Bu yerda bitta film nomiga asoslangan filmlar ruscha videosini bazaga saqlash 
     */
    public function ru_film_store(FilmRuRequest $request, $id)
    {
        if ($request->has('filmvideo')) {
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->filmvideo->extension();
            $request->filmvideo->storeAs('public/ru_film_videos', $videoPath);
            $newFilmRuVideo = new FilmRuVideo();
            $newFilmRuVideo->category_id = $request->category;
            $newFilmRuVideo->brand_id = $request->brand;
            $newFilmRuVideo->film_id = $id;
            $newFilmRuVideo->part = $request->part;
            $newFilmRuVideo->path = $videoPath;
            $newFilmRuVideo->save();
            return redirect(route('films.index'));
        } else {
            return redirect()->back();
        }
    }

    /**
     *  Bu yerda bitta film nomiga asoslangan filmlar videosini viewdan olib yana qo'yish 
     */
    public function  russion_video_remove_put(Request $request)
    {
        $undeletevalue = FilmRuVideo::where('id', $request->film_id)->first();
        if ($undeletevalue) {
            $undeletevalue->delete();
            $undeletevalue->save();
            return response()->json([
                'success' => true
            ]);
        } else {
            $deletevalue = FilmRuVideo::where('id', $request->film_id)->withTrashed()->first();
            $deletevalue->restore();
            $deletevalue->save();
            return response()->json([
                'success' => false
            ]);
        }
    }

    /**
     * Bu yerda bitta film nomiga asoslangan filmlar videosini databasedan butunlay o'chrish
     */
    public function russion_video_compolately_destroy(Request $request)
    {
        $deletevalue = FilmRuVideo::where('id', $request->film_id)->withTrashed()->first();
        if (Storage::exists('public/ru_film_videos/' . $deletevalue->path)) {
            Storage::delete('public/ru_film_videos/' . $deletevalue->path);
        }
        if ($deletevalue) {
            $deletevalue->forceDelete();
            return response()->json([
                'success' => true
            ]);
        }
    }

    /**
     * Bu yerda bitta film nomiga asoslangan filmlar video va qismini
     *  databasedan update qilish uchun kerakli attiributelar jo'natiladi
     */
    public function ru_film_edit($id)
    {
        $ru_film = FilmRuVideo::where('id', $id)->first();
        return view('dashboard.film.ru_film_video.edit', compact('ru_film'));
    }

    /**
     * Bu yerda update qilinayotgan video 
     * qismini takrorlanib qolmaslikka tekshiradi 
     */
    public function russion_video_for_update_get_part(Request $request)
    {
        $check_part_from_film_id = FilmRuVideo::where('film_id', $request->film_id)
            ->where('id', '!=', $request->video_id)
            ->where('part',  $request->part)
            ->exists();
        if ($check_part_from_film_id) {
            return response()->json([
                'error' => true
            ]);
        } else {
            return response()->json([
                'error' => false
            ]);
        }
    }

    /**
     *  Bu yerda bitta filmni update qilamiz
     */
    public function ru_film_update(UpdateFilmRuVideo $request, $id)
    {
        if ($request->hasFile('filmvideo')) {
            $psth = FilmRuVideo::where('id', $id)->first();
            // Delete the old file
            if (Storage::exists('public/ru_film_videos/' . $psth->path)) {
                Storage::delete('public/ru_film_videos/' . $psth->path);
            }
            // Generate a unique filename
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->filmvideo->extension();
            $request->filmvideo->storeAs('public/ru_film_videos', $videoPath);
            // Store the uploaded file
            $russianFilmVideo = FilmRuVideo::find($id);
            $russianFilmVideo->part = $request->part;
            $russianFilmVideo->path = $videoPath;
            $russianFilmVideo->save();
        } else {
            $russianFilmVideo = FilmRuVideo::find($id);
            $russianFilmVideo->part = $request->part;
            $russianFilmVideo->save();
        }
        return redirect(route('films.index'));
    }
}
