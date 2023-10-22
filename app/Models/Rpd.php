<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rpd extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket',
        'rab_id',
        'price',
        'status',
        'balance'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }
}
