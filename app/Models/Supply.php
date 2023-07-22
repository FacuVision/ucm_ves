<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Moddels\History;

class Supply extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * Get all of the comments for the History
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    /**
     * The roles that belong to the Supply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function motions()
    {
        return $this->belongsToMany(Motion::class, 'motion_supply', 'supply_id', 'motion_id')
        ->withPivot('cant', 'motion_price');;

    }
}
