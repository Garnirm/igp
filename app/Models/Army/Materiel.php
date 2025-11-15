<?php

namespace App\Models\Army;

use MongoDB\Laravel\Eloquent\Model;

class Materiel extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'name', 'category_name' ];

    protected $table = 'army_materiel';
}