<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chicken extends Model
{
    use HasFactory;

    protected $fillable = [
      'farmername',
      'farmerPhone',
      'number',
      'date',
      'comments',
    ];
}
