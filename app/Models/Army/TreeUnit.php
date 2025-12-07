<?php

namespace App\Models\Army;

use App\Services\Army\TreeUnitFullPath;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

/**
 * @property string $name
 * @property null|string $parent_id
 * @property null|string $establishment_id
 * @property array<mixed> $effectifs
 * @property array<mixed> $materiels
 * @property array<string> $tags
 */
class TreeUnit extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'parent_id', 'establishment_id', 'effectifs', 'materiels', 'tags' ];

    protected $table = 'army_tree_unit';

    public function generateFullPath(): string
    {
        return (new TreeUnitFullPath($this->id))->generate()->get();
    }

    /**
     * @return BelongsTo<Establishment,$this>
     */
    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    /**
     * @return BelongsTo<Staff,$this>
     */
    public function chief_staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'chief_staff_id');
    }

    /**
     * @return HasMany<TreeUnit,$this>
     */
    public function children(): HasMany
    {
        return $this->hasMany(TreeUnit::class, 'parent_id');
    }

    /**
     * @return HasMany<Staff,$this>
     */
    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class, 'tree_unit_id');
    }
}