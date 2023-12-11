<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateLink extends Model
{
    use HasFactory;

    protected $fillable = ['generated','link'];
}
