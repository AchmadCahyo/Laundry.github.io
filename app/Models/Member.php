<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
