<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'resource_id'
    ];

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
