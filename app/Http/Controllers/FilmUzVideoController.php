<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\FilmUzVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Film\Film_Uz_Video\FilmUzVideoRequest;
use App\Http\Requests\Serial\Uz_Serial_Video\UpdateSerialUzVdeioRequest;

class FilmUzVideoController extends Controller
{
    /**
     *  Bu yerda bitta film nomiga asoslangan filmlar videosi berib yuboriladi
     */
    public function uz_film_index($id)
    {
        $film = Film::where('id', $id)->first();
        $film_uz_videos = FilmUzVideo::withTrashed()->where('film_id', $id)->get();
        return view('dashboard.film.uz_film_video.index', compact('film_uz_videos', 'id', 'film'));
    }

    /**
     *  Bu yerda oldin krirtilgan film video qismlarini tekshiradi
     */
    public function film_uzbek_video_suitable_recipient(Request $request)
    {
        $film = FilmUzVideo::where('film_id', $request->film_id)
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
     *  Bu yerda bitta film nomiga asoslangan filmlar videosi create qilish
     *  uchun idiga asoslanib malumot berib yuboriladi
     */
    public function uz_film_create($id)
    {
        $uz_film = Film::where('id', $id)->first();
        return view('dashboard.film.uz_film_video.create', compact('uz_film'));
    }

    /**
     *  Bu yerda bitta film nomiga asoslangan filmlar videosini bazaga saqlash 
     */
    public function uz_film_store(FilmUzVideoRequest $request, $id)
    {
        if ($request->has('filmvideo')) {
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->filmvideo->extension();
            $request->filmvideo->storeAs('public/uz_film_videos', $videoPath);
            $newFilmUzVideo = new FilmUzVideo();
            $newFilmUzVideo->category_id = $request->category;
            $newFilmUzVideo->brand_id = $request->brand;
            $newFilmUzVideo->film_id = $id;
            $newFilmUzVideo->part = $request->part;
            $newFilmUzVideo->path = $videoPath;
            $newFilmUzVideo->save();
            return redirect(route('films.index'));
        } else {
            return redirect()->back();
        }
    }

    /**
     *  Bu yerda bitta film nomiga asoslangan filmlar videosini viewdan olib yana qo'yish 
     */
    public function film_uzbek_video_remuve_or_put(Request $request)
    {
        $undeletevalue = FilmUzVideo::where('id', $request->film_id)->first();
        if ($undeletevalue) {
            $undeletevalue->delete();
            $undeletevalue->save();
            return response()->json([
                'success' => true
            ]);
        } else {
            $deletevalue = FilmUzVideo::where('id', $request->film_id)->withTrashed()->first();
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
    public function film_uzbek_video_compolately_destroy(Request $request)
    {
        $deletevalue = FilmUzVideo::where('id', $request->film_id)->withTrashed()->first();

        if (Storage::exists('public/uz_film_videos/' . $deletevalue->path)) {
            Storage::delete('public/uz_film_videos/' . $deletevalue->path);
        }
        if ($deletevalue) {
            $deletevalue->forceDelete();
            return response()->json([
                'success' => true
            ]);
        }
    }

    /**
     * Bu yerda bitta film nomiga asoslangan filmlar videosini tahrirlashga yuborish
     */
    public function uz_film_edit($id)
    {
        $uz_film = FilmUzVideo::where('id', $id)->first();
        return view('dashboard.film.uz_film_video.edit', compact('uz_film'));
    }

    /**
     *  Bu yerda uzbek film videosiga assoslangan videoni partini qaytaradi
     */
    public function film_uzbek_video_for_update_get_part(Request $request)
    {
        $check_part_from_film_id = FilmUzVideo::where('film_id', $request->film_id)
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

    public function uz_film_update(UpdateSerialUzVdeioRequest $request, $id)
    {
        if ($request->hasFile('filmvideo')) {
            $psth = FilmUzVideo::where('id', $id)->first();
            if (Storage::exists('public/uz_film_videos/' . $psth->path)) {
                Storage::delete('public/uz_film_videos/' . $psth->path);
            }
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->filmvideo->extension();
            $request->filmvideo->storeAs('public/uz_film_videos', $videoPath);
            $uzbekFilmVideo = FilmUzVideo::find($id);
            $uzbekFilmVideo->part = $request->part;
            $uzbekFilmVideo->path = $videoPath;
            $uzbekFilmVideo->save();
        } else {
            $uzbekFilmVideo = FilmUzVideo::find($id);
            $uzbekFilmVideo->part = $request->part;
            $uzbekFilmVideo->save();
        }
        return redirect(route('films.index'));
    }
}
