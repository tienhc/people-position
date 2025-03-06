<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonPosition extends Model
{
    protected $table = 'people_positions';
    protected $fillable = ['x', 'y'];

    public function distanceFrom($x, $y)
    {
        return sqrt(pow($this->x - $x, 2) + pow($this->y - $y, 2));
    }
}
