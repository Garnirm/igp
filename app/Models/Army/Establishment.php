<?php

namespace App\Models\Army;

use App\Models\City;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Establishment extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'city_id' ];

    protected $table = 'army_establishment';

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}