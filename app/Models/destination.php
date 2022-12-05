<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class destination extends Model
{
    use HasFactory;

    protected $guarded = [];

    //gets key / uuid
    public function getRouteKeyName()
    {
        //returns the uuid at the top of the page as appose to the trains id
        return 'uuid';
    }

    public function trains()
    {
        return $this->hasMany((train::class));
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
