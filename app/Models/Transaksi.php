<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function detail_transaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id');
    }

    public function members()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function outlets()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pakets()
    {
        return $this->belongsToMany(Paket::class,'detail_transaksis', 'transaksi_id','paket_id');
    }
}
