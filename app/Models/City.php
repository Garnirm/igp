<?php

namespace App\Models;

use App\Models\Army\Establishment;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'federal_state_id' ];

    protected $table = 'city';

    public function army_establishments(): HasMany
    {
        return $this->hasMany(Establishment::class, 'city_id');
    }

    public function federal_state(): BelongsTo
    {
        return $this->belongsTo(FederalState::class, 'federal_state_id');
    }
}