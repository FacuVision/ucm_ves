<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Supply;
use App\Models\User;

class History extends Model
{
    use HasFactory;

    /**
     * Get all of the comments for the History
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    /**
     * Get the user that owns the History
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
