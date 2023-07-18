<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motion;

class Car extends Model
{
    use HasFactory;

    public function motion() {
        return $this->belongsTo(Motion::class);
    }
}
