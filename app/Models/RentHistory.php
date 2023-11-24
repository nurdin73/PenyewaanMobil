<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentHistory extends Model
{
    use HasFactory;
    
    const RENT = 'RENT';
    const RETURNED = 'RETURNED';

    protected $fillable = ['rent_id', 'status'];

    public function rent()
    {
        return $this->belongsTo(Rent::class, 'rent_id', 'id');
    }
}