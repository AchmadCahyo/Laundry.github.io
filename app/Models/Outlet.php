<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function paket()
    {
        return $this->hasOne(Paket::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
