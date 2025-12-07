<?php

namespace App\Models\Army;

use App\Models\City;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $city_id
 */
class Establishment extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'city_id' ];

    protected $table = 'army_establishment';

    /**
     * @return BelongsTo<City,$this>
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return HasMany<TreeUnit,$this>
     */
    public function tree_units(): HasMany
    {
        return $this->hasMany(TreeUnit::class, 'establishment_id');
    }
}