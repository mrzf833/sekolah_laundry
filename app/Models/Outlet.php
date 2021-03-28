<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function pakets()
    {
        return $this->hasMany(Paket::class, 'outlet_id', 'id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'outlet_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'outlet_id', 'id');
    }
}
