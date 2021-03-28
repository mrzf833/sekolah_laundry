<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'member_id', 'id');
    }
}
