<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'activity_id'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
