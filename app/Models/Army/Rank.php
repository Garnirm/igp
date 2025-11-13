<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;

class Rank extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'order', 'minimum_pay' ];

    protected $table = 'army_rank';
}