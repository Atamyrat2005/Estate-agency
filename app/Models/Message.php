<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
    ];
    const UPDATED_AT = null;

    protected $fillable = ['name','phone','text'];
}
