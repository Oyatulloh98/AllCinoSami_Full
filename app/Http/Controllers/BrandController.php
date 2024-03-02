<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brand.index', compact('brands'));
    }

    /**
     * Display a listing of the resource.
     */
    public function branddeletes()
    {
        $brands = Brand::onlyTrashed()->get();
        return view('dashboard.brand.branddeletes', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->category_id = $request->categories;
        $brand->save();

        return redirect()->back()->with('success', 'Brand created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $category = Category::all();
        return view('dashboard.brand.edit', compact([
            'brand',
            'category',
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update([
            'category_id' => $request->categories,
            'name' => $request->name
        ]);
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            // Assuming $categoryId is the ID of the category you want to delete
            $brand->delete();
            $brand->serialUzVideo()->delete();
            $brand->serialRuVideo()->delete();
            $brand->serials()->delete();
            // Now fetch the categories again after deletion
            $brands = Brand::where('deleted_at', null)->get();
            // Assuming you have imported the necessary classes for the view function

            // Render the updated HTML after deletion
            $html = view('dashboard.brand.ajax.brandundeletes', compact('brands'))->render();

            return response()->json([
                'message' => 'Brand deleted successfully',
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete category'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function rebrand($id)
    {
        $trashedBrand = Brand::onlyTrashed()->find($id);

        if ($trashedBrand) {
            $categoryId = $trashedBrand->category_id;

            // Check if there are any other trashed brands with the same category_id
            $otherTrashedBrandsCount = Category::where('id', $categoryId)->onlyTrashed()->count();

            if ($otherTrashedBrandsCount == 0) {
                // No other trashed brands found with the same category_id, so restore the brand
                $trashedBrand->restore();
                $trashedBrand->serials()->restore();
                $trashedBrand->serialUzVideo()->restore();
                $trashedBrand->serialRuVideo()->restore();
                $brands = Brand::onlyTrashed()->get();
                $html = view('dashboard.brand.ajax.branddeletes', compact('brands'))->render();
                return response()->json([
                    'message' => 'Brand restored successfully',
                    'html' => $html
                ]);
            } else {
                // Other trashed brands found with the same category_id
                $brands = Brand::onlyTrashed()->get();
                $html = view('dashboard.brand.ajax.branddeletes', compact('brands'))->render();
                return response()->json([
                    'error' => 'Brand not restored. Other brands with the same category are still trashed.',
                    'html' => $html
                ]);
            }
        } else {
            // Trashed brand not found
            $brands = Brand::onlyTrashed()->get();
            $html = view('dashboard.brand.ajax.branddeletes', compact('brands'))->render();
            return response()->json([
                'error' => 'Trashed brand not found',
                'html' => $html
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forcedelete($id)
    {
        try {
            // Assuming $id is the ID of the category you want to force delete
            $brand = Brand::withTrashed()->findOrFail($id);
            $brand->forcedelete();

            // Now fetch the categories again after deletion
            $brands = Category::onlyTrashed()->get();

            // Render the updated HTML after deletion
            $html = view('dashboard.brand.ajax.branddeletes', compact('brands'))->render();

            return response()->json([
                'message' => 'Brand force deleted successfully',
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to force delete brand'], 500);
        }
    }
}
