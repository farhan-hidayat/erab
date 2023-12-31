<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'classification_id'
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
