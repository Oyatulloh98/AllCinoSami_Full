<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Serial;
use App\Models\Category;
use App\Models\SerialImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Serial\StoreSerialRequest;
use App\Http\Requests\Serial\UpdateSerialRequest;

class SerialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serials = Serial::all();
        return view('dashboard.serial.index', compact('serials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $selectedCategory = $categories->first();
        $selectedCategoryBrands = $selectedCategory->brands;
        return view('dashboard.serial.create', compact('categories', 'brands', 'selectedCategory', 'selectedCategoryBrands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSerialRequest $request)
    {
        $newSerial = new Serial();
        $newSerial->name_uz = $request->name_uz;
        $newSerial->name_ru = $request->name_ru;
        $newSerial->category_id = $request->category;
        $newSerial->brand_id = $request->brand;
        $newSerial->save();

        if ($request->hasFile('imageserial')) {
            $imagePath = md5(rand(1111, 9999) . microtime()) . "." . $request->imageserial->extension();
            $request->imageserial->storeAs('public/serial_images', $imagePath);
            $newSerialImage = new SerialImage();
            $newSerialImage->category_id = $request->category;
            $newSerialImage->brand_id = $request->brand;
            $newSerialImage->serial_id = $newSerial->id;
            $newSerialImage->path = $imagePath;
            $newSerialImage->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Serial $serial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serial $serial)
    {
        $categories = Category::all();
        $brands = Brand::where('category_id', $serial->category_id)->get();
        return view('dashboard.serial.edit', compact('serial', 'categories', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getBrandsByCategory(Request $request)
    {
        $brands = Brand::where('category_id', $request->category_id)->get();
        return response()->json($brands);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSerialRequest $request, Serial $serial)
    {
        if ($request->has('imageserial')) {
            Storage::delete('public/serial_images/' . $serial->serial_image[0]['path']);
            $imagePath = md5(rand(1111, 9999) . microtime()) . "." . $request->imageserial->extension();
            $request->imageserial->storeAs('public/serial_images', $imagePath);
            $image_serial = SerialImage::where('serial_id', $serial->id)->first();
            $image_serial->update([
                'category_id' => $request->category,
                'brand_id' => $request->brand,
                'serial_id' => $serial->id,
                'path' => $imagePath
            ]);
            $serial_update = Serial::find($serial->id);
            $serial_update->category_id = $request->category;
            $serial_update->brand_id = $request->brand;
            $serial_update->name_uz = $request->name_uz;
            $serial_update->name_ru = $request->name_ru;
            $serial_update->save();
            return redirect(route('serial.index'));
        } else {
            $serial_update = Serial::find($serial->id);
            $serial_update->category_id = $request->category;
            $serial_update->brand_id = $request->brand;
            $serial_update->name_uz = $request->name_uz;
            $serial_update->name_ru = $request->name_ru;
            $serial_update->save();
            return redirect(route('serial.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serial $serial, $id)
    {
        $serial = Serial::where('id', $id)->first();
        try {
            // Assuming $categoryId is the ID of the category you want to delete
            $serial->delete();
            $serial->serialuzvideo()->delete();
            $serial->serialruvideo()->delete();
            // Now fetch the categories again after deletion
            $serials = Serial::where('deleted_at', null)->get();
            // Assuming you have imported the necessary classes for the view function

            // Render the updated HTML after deletion
            $html = view('dashboard.serial.ajax.ajaxdelete', compact('serials'))->render();

            return response()->json([
                'message' => 'Serial deleted successfully',
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete serial'], 500);
        }
    }

    public function allserialdeletes()
    {
        $serials = Serial::onlyTrashed()->get();
        return view('dashboard.serial.deletedserials', compact('serials'));
        // dd($serials);
    }

    public function reserials($id)
    {
        $trashedBrand = Serial::onlyTrashed()->find($id);

        if ($trashedBrand) {
            $categoryId = $trashedBrand->category_id;
            $brandId = $trashedBrand->brand_id;

            // Check if there are any other trashed brands with the same category_id
            $otherTrashedBrandsCount = Category::where('id', $categoryId)->onlyTrashed()->count();
            $anotherTrashedBrandsCount = Brand::where('id', $brandId)->onlyTrashed()->count();

            if ($otherTrashedBrandsCount == 0 && $anotherTrashedBrandsCount == 0) {
                // No other trashed brands found with the same category_id, so restore the brand
                $trashedBrand->restore();
                $trashedBrand->serialuzvideo()->restore();
                $trashedBrand->serialruvideo()->restore();
                $serials = Serial::onlyTrashed()->get();
                $html = view('dashboard.serial.ajax.deletedserials', compact('serials'))->render();
                return response()->json([
                    'message' => 'Serial restored successfully',
                    'html' => $html
                ]);
            } else {
                // Other trashed brands found with the same category_id
                $serials = Serial::onlyTrashed()->get();
                $html = view('dashboard.serial.ajax.deletedserials', compact('serials'))->render();
                return response()->json([
                    'error' => 'Serial not restored. Other brands with the same category are still trashed.',
                    'html' => $html
                ]);
            }
        } else {
            // Trashed brand not found
            $serials = Serial::onlyTrashed()->get();
            $html = view('dashboard.serial.ajax.deletedserials', compact('serials'))->render();
            return response()->json([
                'error' => 'Trashed Serial not found',
                'html' => $html
            ]);
        }
    }
}
