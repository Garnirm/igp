<?php

namespace App\Models\Army;

use Carbon\Carbon;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $staff_id
 * @property Carbon|string $start_date
 * @property Carbon|null|string $end_date
 * @property string $rank_id
 * @property string $role_id
 * @property string $tree_unit_id
 * @property bool $active
 */
class StaffAssignment extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'staff_id', 'start_date', 'end_date', 'rank_id', 'role_id', 'tree_unit_id', 'active' ];

    protected $table = 'army_staff_assignment';

    /**
     * @return BelongsTo<Staff,$this>
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
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