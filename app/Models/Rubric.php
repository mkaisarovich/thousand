<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'rubric',
    ];
}
