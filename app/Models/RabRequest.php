<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket',
        'price',
        'balance',
        'year',
        'status',
    ];

    public function rabs()
    {
        return $this->hasMany(Rab::class);
    }

    public function rpds()
    {
        return $this->hasMany(Rpd::class);
    }
}
