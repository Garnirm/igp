<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Citizen extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'firstname', 'lastname', 'sexe', 'city_id',
    ];

    protected $table = 'citizen';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}