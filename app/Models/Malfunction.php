<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Malfunction extends Model
{
    use HasFactory;

    protected $fillable = ['detected_at', 'resolved_at', 'description', 'forklift_id'];

    protected $dates = ['detected_at', 'resolved_at'];

    public function forklift()
    {
        return $this->belongsTo(Forklift::class);
    }

    public function getDowntimeAttribute()
    {
        if ($this->resolved_at) {
            return $this->resolved_at->diffInMinutes($this->detected_at);
        }
        return null;
    }
}
