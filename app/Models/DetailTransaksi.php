<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function transaksis()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

    public function pakets()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }
}
