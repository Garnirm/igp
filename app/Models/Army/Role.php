<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'description' ];

    protected $table = 'army_role';
}