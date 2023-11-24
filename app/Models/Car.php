<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'merk', 'model', 'no_plat', 'price_rent_by_day', 'is_rent'];

    public function rents()
    {
        return $this->hasMany(Rent::class, 'car_id', 'id');
    }

    public function lastRent() {
        return $this->belongsTo(Rent::class, 'id', 'car_id')->orderBy('created_at', 'desc');
    }
}