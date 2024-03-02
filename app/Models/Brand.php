<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function serials()
    {
        return $this->hasMany(Serial::class, 'brand_id');
    }

    public function serialUzVideo()
    {
        return $this->hasMany(SerialUzVideo::class, 'brand_id');
    }
    public function serialRuVideo()
    {
        return $this->hasMany(SerialRuVideo::class, 'brand_id');
    }
}
