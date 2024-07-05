<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forklift extends Model
{
    use HasFactory;

    protected $fillable = ['brand', 'number', 'capacity'];

    public function malfunctions()
    {
        return $this->hasMany(Malfunction::class);
    }
}
