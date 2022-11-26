<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Estate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['pivot'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function values()
    {
        return $this->belongsToMany(Value::class, 'estate_values')
            ->orderBy('estate_values.sort_order');
    }

    public function isNew()
    {
        if ($this->created_at >= Carbon::today()->subMonth()->toDateTimeString()) {
            return true;
        } else {
            return false;
        }
    }

    public function image()
    {
        if ($this->image) {
            return Storage::url('public/estates/' . $this->image);
        } else {
            return asset('img/temp/estate.jpg');
        }
    }

    public function name()
    {
        if (app()->isLocale('en')) {
            return $this->name_en ?: $this->name;
        }elseif (app()->isLocale('ru')) {
            return $this->name_ru ?: $this->name;
        }else {
            return $this->name;
        }
    }
}
