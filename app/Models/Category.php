<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name_uz',
        'name_ru',
    ];

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id');
    }
    public function serials()
    {
        return $this->hasMany(Serial::class, 'category_id');
    }
    public function serialUzVideo()
    {
        return $this->hasMany(SerialUzVideo::class, 'category_id');
    }
    public function serialRuVideo()
    {
        return $this->hasMany(SerialRuVideo::class, 'category_id');
    }
}
