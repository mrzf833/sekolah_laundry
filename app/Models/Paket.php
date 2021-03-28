<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function outlets()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'paket_id', 'id');
    }
}
