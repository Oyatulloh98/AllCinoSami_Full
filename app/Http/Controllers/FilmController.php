<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageFilm;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Film\StoreFilmRequest;
use App\Http\Requests\Film\UpdateFilmRequest;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films = Film::all();
        return view('dashboard.film.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.film.create', compact('categories'));
    }

    /**
     * When selecting a category, it returns the corresponding brand.
     */
    public function select_brand(Request $request)
    {
        $brand = Brand::where('category_id', $request->id)->get(); // Barcha brendlar
        if ($brand->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'brand' => $brand
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFilmRequest $request)
    {


        $newFilm = new Film();
        $newFilm->name_uz = $request->name_uz;
        $newFilm->name_ru = $request->name_ru;
        $newFilm->category_id = $request->category;
        $newFilm->brand_id = $request->brand;
        $newFilm->save();

        if ($request->hasFile('imagefilm')) {
            $imagePath = md5(rand(1111, 9999) . microtime()) . "." . $request->imagefilm->extension();
            $request->imagefilm->storeAs('public/film_images', $imagePath);
            $newFilmImage = new ImageFilm();
            $newFilmImage->category_id = $request->category;
            $newFilmImage->brand_id = $request->brand;
            $newFilmImage->film_id = $newFilm->id;
            $newFilmImage->path = $imagePath;
            $newFilmImage->save();
        }

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        $categories = Category::all();
        return view('dashboard.film.edit', compact('film', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFilmRequest $request, Film $film)
    {
        if ($request->has('imagefilm')) {
            Storage::delete('public/film_images/' . $film->film_image[0]['path']);
            $imagePath = md5(rand(1111, 9999) . microtime()) . "." . $request->imagefilm->extension();
            $request->imagefilm->storeAs('public/film_images', $imagePath);
            $image_film = ImageFilm::where('film_id', $film->id)->first();
            $image_film->update([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'film_id' => $film->id,
                'path' => $imagePath
            ]);
            $film->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ]);
        } else {
            $image_film = ImageFilm::where('film_id', $film->id)->first();
            $image_film->update([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'film_id' => $film->id,
            ]);
            $film->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'category_id' => $request->category,
                'brand_id' => $request->brand,
            ]);
        }
        return redirect(route('films.index'));
    }

    /**
     * Deleted at the specified resource from storage.
     */
    public function film_one_delete_store($id)
    {
        $will_delete_film = Film::where('id', $id)->first();
        $will_delete_film->delete();

        $films = Film::all();

        $html = view('dashboard.film.filmRender.index', compact('films'))->render();
        return response()->json([
            'message' => "Successfully deleted film all russian film and uzbek film ",
            'html' => $html
        ]);
    }

    /**
     *  Only deleted_at have column get
     */
    public function  films_is_deleted()
    {
        $films = Film::onlyTrashed()->get();
        return view('dashboard.film.deleted', compact('films'));
    }

    public function films_restore($id)
    {
        $will_restore_film = Film::onlyTrashed()->where('id', $id)->first();
        $will_restore_film->restore();
        $films = Film::onlyTrashed()->get();
        $html = view('dashboard.film.filmRender.delete', compact('films'))->render();
        return response()->json([
            'message' => "Successfully restored film all russian film and uzbek fill ",
            'html' => $html
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function films_remove(Request $request)
    {
        $will_remove_film = Film::onlyTrashed()->where('id', $request->id)->first();
        Storage::delete('public/film_images/' . $will_remove_film->film_image[0]['path']);
        $will_remove_film->forceDelete();
        $films = Film::onlyTrashed()->get();
        $html = view('dashboard.film.filmRender.delete', compact('films'))->render();
        return response()->json([
            'message' => "Successfully remove in database film all russian film and uzbek fill ",
            'html' => $html
        ]);
    }
}
