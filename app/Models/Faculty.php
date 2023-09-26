<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
