<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class StaffAssignment extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'staff_id', 'start_date', 'end_date', 'rank_id', 'role_id', 'tree_unit_id', 'active' ];

    protected $table = 'army_staff_assignment';

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function tree_unit(): BelongsTo
    {
        return $this->belongsTo(TreeUnit::class, 'tree_unit_id');
    }
}