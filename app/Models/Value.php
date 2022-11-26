<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $hidden = ['pivot'];


    public function option()
    {
        return $this->belongsTo(Option::class);
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

    public function estates()
    {
        return $this->belongsToMany(Estate::class, 'estate_values');
    }
}