<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rab extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket',
        'user_id',
        'component_id',
        'type_id',
        'description',
        'volume',
        'frequency',
        'price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
