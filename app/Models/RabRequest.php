<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_id',
        'sub_component_id',
        'program_id',
        'description',
        'volume',
        'unit',
        'price',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function sub_component()
    {
        return $this->belongsTo(SubComponent::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
