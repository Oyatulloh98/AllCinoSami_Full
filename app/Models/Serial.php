<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Serial extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function serialImagePath()
    {
        return asset('') . 'storage/serial_images/';
    }
    public function serial_image()
    {
        return $this->hasMany(SerialImage::class);
    }
    public function serialuzvideo()
    {
        return $this->hasMany(SerialUzVideo::class, 'serial_id');
    }
    public function serialruvideo()
    {
        return $this->hasMany(SerialRuVideo::class, 'serial_id');
    }
}
