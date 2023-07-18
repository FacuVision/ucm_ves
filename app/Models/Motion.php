<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motion;


class Motion extends Model
{
    use HasFactory;

    public function cars() {
        return $this->hasMany(Car::class);
    }

    /**
     * The roles that belong to the Motion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function supplies(): BelongsToMany
    {
        return $this->belongsToMany(Supply::class);
    }


}
