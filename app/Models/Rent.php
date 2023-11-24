<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    
    protected $fillable = ['car_id', 'user_id', 'start_date', 'end_date', 'amount'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(RentHistory::class, 'rent_id', 'id')->orderBy('created_at', 'asc');
    }

    public function history()
    {
        return $this->belongsTo(RentHistory::class, 'id', 'rent_id')->orderBy('created_at', 'asc');
    }
}