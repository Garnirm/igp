<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class FederalState extends Model
{
    public $timestamps = false;

    protected $table = 'federal_state';
}