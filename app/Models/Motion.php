<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motion;


class Motion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function car() {
        return $this->belongsTo(Car::class);
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
