<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    public function tarif() {
        return $this->belongsTo(TarifParkir::class, 'tarif_parkir_id');
    }

    public function area() {
        return $this->belongsTo(AreaParkir::class, 'area_parkir_id');
    }

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}