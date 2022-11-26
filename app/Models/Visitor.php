<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }
}