<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;

class TreeUnitTemplate extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'items' ];

    protected $table = 'army_tree_unit_template';

    protected $casts = [
        'items' => 'array', 
    ];
}