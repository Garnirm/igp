<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class TreeUnit extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'parent_id', 'establishment_id', 'effectifs', 'materiels' ];

    protected $table = 'army_tree_unit';

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(TreeUnit::class, 'parent_id');
    }
}