<?php

namespace App\Http\Controllers;

use App\Models\Serial;
use Illuminate\Http\Request;
use App\Models\SerialUzVideo;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Serial\Uz_Serial_Video\StoreSerialUzVideoRequest;
use App\Http\Requests\Serial\Uz_Serial_Video\UpdateSerialUzVdeioRequest;

class SerialUzVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function uz_serial_index($id)
    {
        $serial = Serial::where('id', $id)->withTrashed()->first();
        $serial_uz_videos = SerialUzVideo::where('serial_id', $id)->withTrashed()->get();
        return view('dashboard.serial.uzserialvideo.index', compact('serial_uz_videos', 'id', 'serial'));
    }

    /**
     *  Idsiga qarab ayni serialga qism qo'shadi
     */
    public function uz_serial_create($id)
    {
        $serial = Serial::where('id', $id)->first();
        return view('dashboard.serial.uzserialvideo.create', compact('serial'));
    }

    /**
     *  Idsiga qarab ayni serialni qo'shadi
     */

    public function uz_serial_store(StoreSerialUzVideoRequest $request, $id)
    {
        $serial = Serial::where('id', $id)->first();
        if ($serial) {
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->serialvideo->extension();
            $request->serialvideo->storeAs('public/uz_serial_videos/', $videoPath);

            $uzvideo = new SerialUzVideo();
            $uzvideo->category_id = $request->category;
            $uzvideo->brand_id = $request->brand;
            $uzvideo->serial_id = $id;
            $uzvideo->part = $request->part;
            $uzvideo->path = $videoPath;
            $uzvideo->save();
            return redirect(route('UzbekSerialVideo.index',$id));
        } else {
            return redirect()->back();
        }
    }

    public function serial_uzbek_video_suitable_recipient(Request $request)
    {
        $serial = SerialUzVideo::where('serial_id', $request->serial_id)
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

    public function uz_serial_edit(SerialUzVideo $serialUzVideo, $id)
    {
        $serialUzVideo = SerialUzVideo::where('id', $id)->withTrashed()->first();
        return view('dashboard.serial.uzserialvideo.edit', compact('serialUzVideo'));
    }

      /**
     *  Bu yerda uzbek film videosiga assoslangan videoni partini qaytaradi
     */
    public function serial_uzbek_video_for_update_get_part(Request $request)
    {
        $check_part_from_serial_id = SerialUzVideo::where('serial_id', $request->serial_id)
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

    public function uz_serial_update(UpdateSerialUzVdeioRequest $request, $id)
    {
        if ($request->hasFile('serialvideo')) {
            $psth = SerialUzVideo::where('id', $id)->first();

            // Delete the old file
            if (Storage::exists('public/uz_serial_videos/' . $psth->path)) {
                Storage::delete('public/uz_serial_videos/' . $psth->path);
            }
            $videoPath = md5(rand(1111, 9999) . microtime()) . "." . $request->serialvideo->extension();
            $request->serialvideo->storeAs('public/uz_serial_videos/', $videoPath);

            $serialUzVideo = SerialUzVideo::find($id);
            $serialUzVideo->part = $request->part;
            $serialUzVideo->path = $videoPath;
            $serialUzVideo->save();
        } else {
            // If no new file is uploaded, just update the part
            $serialUzVideo = SerialUzVideo::withTrashed()->find($id);
            $serialUzVideo->part = $request->part;
            $serialUzVideo->save();
        }
        return redirect(route('UzbekSerialVideo.index',$serialUzVideo->serial_for_serial_video->id));
    }

    public function serial_uzbek_video_remuve_or_put(Request $request)
    {

        $undeletevalue = SerialUzVideo::where('id', $request->serial_id)->first();
        if ($undeletevalue) {
            $undeletevalue->delete();
            $undeletevalue->save();
            return response()->json([
                'success' => true
            ]);
        } else {
            $deletevalue = SerialUzVideo::where('id', $request->serial_id)->withTrashed()->first();
            $deletevalue->restore();
            $deletevalue->save();
            return response()->json([
                'success' => false
            ]);
        }
    }

    public function serial_uzbek_video_compolately_destroy(Request $request)
    {
        $deletevalue = SerialUzVideo::where('id', $request->serial_id)->withTrashed()->first();

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
