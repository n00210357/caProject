<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        //returns the uuid at the top of the page as appose to the trains id
        return 'uuid';
    }

    public function train()
    {
        return $this->belongsToMany(train::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
