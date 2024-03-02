<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Routing\Controller;
use App\Http\Requests\Category\CategoryPostRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view(
            'dashboard.category.index',
            compact(
                [
                    'categories'
                ]
            )
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function catdeletes()
    {
        $categories = Category::onlyTrashed()->get();
        return view(
            'dashboard.category.catdeletes',
            compact(
                [
                    'categories'
                ]
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryPostRequest $request)
    {
        Category::create([
            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category_update = Category::find($category->id);
        $category_update->name_uz = $request->name_uz;
        $category_update->name_ru = $request->name_ru;
        $category_update->save();
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Assuming $categoryId is the ID of the category you want to delete
            $category->delete();
            $category->brands()->delete();
            $category->serials()->delete();
            $category->serialUzVideo()->delete();
            $category->serialRuVideo()->delete();
            // Now fetch the categories again after deletion
            $categories = Category::where('deleted_at', null)->get();
            // Assuming you have imported the necessary classes for the view function

            // Render the updated HTML after deletion
            $html = view('dashboard.category.ajax.catundeletes', compact('categories'))->render();

            return response()->json([
                'message' => 'Category deleted successfully',
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete category'], 500);
        }
    }

    /**
     * Restore category here form id
     */
    public function recategory($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->brands()->restore();
        $category->serials()->restore();
        $category->serialUzVideo()->restore();
        $category->serialRuVideo()->restore();
        $category->restore();
        $categories = Category::onlyTrashed()->get();
        $html = view('dashboard.category.ajax.catdeletes', compact('categories'))->render();
        return response()->json(
            [
                'message' => 'Category restored successfully',
                'html' => $html
            ]
        );
    }

    /**
     * Force delete from category table
     */
    public function forcedelete($id)
    {
        try {
            // Assuming $id is the ID of the category you want to force delete
            $category = Category::withTrashed()->findOrFail($id);
            $category->brands()->forceDelete(); // Corrected method name
            $category->serialUzVideo()->forceDelete();
            $category->serialRuVideo()->forceDelete();
            $category->forceDelete(); // Force delete the category itself

            // Now fetch the categories again after deletion
            $categories = Category::onlyTrashed()->get();

            // Render the updated HTML after deletion
            $html = view('dashboard.category.ajax.catdeletes', compact('categories'))->render();

            return response()->json([
                'message' => 'Category force deleted successfully',
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to force delete category'], 500);
        }
    }
}
