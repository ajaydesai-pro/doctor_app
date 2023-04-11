<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotModal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'slot_timing_id',
        'day_id'
    ];

    public function slot_timing()
    {
        return $this->belongsTo(SlotTimingModal::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function day()
    {
        return $this->belongsTo(DayModal::class);
    }
}
