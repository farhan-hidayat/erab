<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'detail_id'
    ];

    public function Detail()
    {
        return $this->belongsTo(Detail::class);
    }
}
