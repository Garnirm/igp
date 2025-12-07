<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

/**
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $rank_id
 * @property string $role_id
 * @property string $tree_unit_id
 */
class Staff extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'firstname', 'lastname', 'rank_id', 'role_id', 'tree_unit_id' ];

    protected $table = 'army_staff';

    /**
     * @return HasMany<StaffAssignment,$this>
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(StaffAssignment::class, 'staff_id');
    }

    /**
     * @return BelongsTo<Rank,$this>
     */
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    /**
     * @return BelongsTo<Role,$this>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return BelongsTo<TreeUnit,$this>
     */
    public function tree_unit(): BelongsTo
    {
        return $this->belongsTo(TreeUnit::class, 'tree_unit_id');
    }
}