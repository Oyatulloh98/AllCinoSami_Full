<?php

namespace App\Http\Controllers;

use App\Http\Requests\Serial\Ru_Serial_Video\StoreSerialRuVideoRequest;
use App\Models\Serial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SerialRuVideo;
use Illuminate\Support\Facades\Storage;

class SerialRuVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ru_serial_index($id)
    {
        $serial = Serial::where('id', $id)->withTrashed()->first();
        $uzvideos = SerialRuVideo::where('serial_id', $id)->withTrashed()->get();
        return view('dashboard.serial.ruserialvideo.index', compact('uzvideos', 'id', 'serial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ru_serial_create($id)
    {
        $serial = Serial::where('id', $id)->first();
        return view('dashboard.serial.ruserialvideo.create', compact('serial'));
    }

    public function serial_russian_video_suitable_recipient(Request $request)
    {
        $serial = SerialRuVideo::where('serial_id', $request->RuserialId)
            ->where('part', $request->part)
            ->first();

        if ($serial) {
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
     * Store a newly created resource in storage.
     */
    public function ru_serial_store(StoreSerialRuVideoRequest $request, $id)
    {
        $serial = Serial::where('id', $id)->first();
        if ($serial) {
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->serialvideo->extension();
            $request->serialvideo->storeAs('public/ru_serial_videos/', $videoPath);

            $uzvideo = new SerialRuVideo();
            $uzvideo->category_id = $request->category;
            $uzvideo->brand_id = $request->brand;
            $uzvideo->serial_id = $id;
            $uzvideo->part = $request->part;
            $uzvideo->path = $videoPath;
            $uzvideo->save();
            return redirect(route('RussianSerialVideo.index', $id));
        } else {
            return redirect(route('RussianSerialVideo.index', $id));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SerialRuVideo $serialRuVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function ru_serial_edit(SerialRuVideo $serialRuVideo, $id)
    {
        // dd($id);
        $serialRuVideo = SerialRuVideo::where('id', $id)->withTrashed()->first();
        return view('dashboard.serial.ruserialvideo.edit', compact('serialRuVideo'));
    }

    public function serial_russian_video_for_update_get_part(Request $request)
    {
        $check_part_from_serial_id = SerialRuVideo::where('serial_id', $request->serial_id)
            ->where('id', '!=', $request->video_id)
            ->where('part',  $request->part)
            ->exists();
        if ($check_part_from_serial_id) {
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
     * Update the specified resource in storage.
     */
    public function ru_serial_update(Request $request, SerialRuVideo $serialRuVideo, $id)
    {
        if ($request->hasFile('serialvideo')) {
            $psth = SerialRuVideo::where('id', $id)->first();

            // Delete the old file
            if (Storage::exists('public/ru_serial_videos/' . $psth->path)) {
                Storage::delete('public/ru_serial_videos/' . $psth->path);
            }
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->serialvideo->extension();
            $request->serialvideo->storeAs('public/ru_serial_videos/', $videoPath);

            $serialRuVideo = SerialRuVideo::find($id);
            $serialRuVideo->part = $request->part;
            $serialRuVideo->path = $videoPath;
            $serialRuVideo->save();
        } else {
            // If no new file is uploaded, just update the part
            $serialRuVideo = SerialRuVideo::find($id);
            $serialRuVideo->part = $request->part;
            $serialRuVideo->save();
        }
        return redirect(route('RussianSerialVideo.index',$serialRuVideo->serial_for_serial_video->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function serial_russian_video_remuve_or_put(Request $request)
    {
        $undeletevalue = SerialRuVideo::where('id', $request->serial_id)->first();
        if ($undeletevalue) {
            $undeletevalue->delete();
            $undeletevalue->save();
            return response()->json([
                'success' => true
            ]);
        } else {
            $deletevalue = SerialRuVideo::where('id', $request->serial_id)->withTrashed()->first();
            $deletevalue->restore();
            $deletevalue->save();
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function serial_russian_video_compolately_destroy(Request $request)
    {
        $deletevalue = SerialRuVideo::where('id', $request->serial_id)->withTrashed()->first();


        // Delete the old file
        if (Storage::exists('public/serial_uz_videos/' . $deletevalue->path)) {
            Storage::delete('public/serial_uz_videos/' . $deletevalue->path);
        }
        if ($deletevalue) {
            $deletevalue->forceDelete();
            return response()->json([
                'success' => true
            ]);
        }
    }
}
