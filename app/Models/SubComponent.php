<?php

namespace App\Models;

use App\Http\Requests\Rab_RequestRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'component_id',
        'user_id'
    ];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rab_details()
    {
        return $this->hasMany(RabDetail::class);
    }

    public function rab_requests()
    {
        return $this->hasMany(Rab_RequestRequest::class);
    }
}
