<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nama_area', 'kapasitas', 'terisi'])]
class Area extends Model
{
    use HasFactory;

    protected $table = 'areas';
}