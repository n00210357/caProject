<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    public function train()
    {
        return $this->belongsToMany(train::class)->withTimestamps();
    }
}
