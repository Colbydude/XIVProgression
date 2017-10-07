<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'lodestone_id', 'name', 'server', 'avatar'
    ];
}
