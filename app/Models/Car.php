<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motion;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function motions() {
        return $this->hasMany(Motion::class);
    }
}
