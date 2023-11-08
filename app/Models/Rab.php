<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use HasFactory;

    protected $fillable = [
        'rab_request_id',
        'price',
        'year',
        'status',
    ];

    public function rab_details()
    {
        return $this->hasMany(RabDetail::class);
    }

    public function rab_request()
    {
        return $this->belongsTo(RabRequest::class);
    }
}
