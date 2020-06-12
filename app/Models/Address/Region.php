<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function getRegions()
    {
        return $this->all();
    }
    public function city()
    {
        return $this->hasMany(City::class);
    }
}
