<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    //grants basic protection
    protected $guarded = [];

    //gets key / uuid
    public function getRouteKeyName()
    {
        //returns the uuid at the top of the page as appose to the trains id
        return 'uuid';
    }

    //links driver to trains as a foreign key
    public function train()
    {
        return $this->belongsToMany(train::class)->withTimestamps();
    }

    //links driver to user as a foreign key
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
