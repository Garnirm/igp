<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'federal_state_id' ];

    protected $table = 'city';

    public function federal_state(): BelongsTo
    {
        return $this->belongsTo(FederalState::class, 'federal_state_id');
    }
}