<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;

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
    public function supplies()
    {
        //return $this->belongsToMany(Supply::class);
        return $this->belongsToMany(Supply::class, 'motion_supply', 'motion_id', 'supply_id')
        ->withPivot('cant');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
