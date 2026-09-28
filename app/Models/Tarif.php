<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['jenis_kendaraan', 'tarif_pertama', 'tarif_berikutnya'])]
class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarifs';
}