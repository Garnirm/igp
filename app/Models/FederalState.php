<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class FederalState extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'capital_city_id' ];

    protected $table = 'federal_state';

    public function capital(): BelongsTo
    {
        return $this->belongsTo(City::class, 'capital_city_id');
    }
}