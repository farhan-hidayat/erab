<?php

namespace App\Models;

use App\Http\Requests\Rab_RequestRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
    ];

    public function rab_details()
    {
        return $this->hasMany(RabDetail::class);
    }

    public function rab_requests()
    {
        return $this->hasMany(Rab_RequestRequest::class);
    }
}
