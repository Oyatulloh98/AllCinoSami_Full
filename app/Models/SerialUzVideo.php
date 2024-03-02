<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerialUzVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category_for_uz_video()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brand_for_uz_video()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function serial_for_serial_video()
    {
        return $this->belongsTo(Serial::class, 'serial_id');
    }
    public function serial_uz_video_path()
    {
        return asset('') . 'storage/uz_serial_videos/';
    }
}
