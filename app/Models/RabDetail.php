<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RabDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rab_id',
        'sub_component_id',
        'program_id',
        'type_id',
        'description',
        'volume',
        'unit',
        'price',
        'total'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }

    public function sub_component()
    {
        return $this->belongsTo(SubComponent::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
