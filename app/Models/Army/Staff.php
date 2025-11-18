<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Staff extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'firstname', 'lastname', 'rank_id', 'role_id', 'tree_unit_id' ];

    protected $table = 'army_staff';

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}