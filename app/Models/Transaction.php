<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getConvertHourAttribute()
    {
        $startHour = 8;
        $convertedHour = $startHour + $this->hour - 1;
        $endHour = $convertedHour + 1;

        if ($convertedHour < 12) {
            $convertedHour .= '-' . $endHour . 'am';
        } elseif ($convertedHour == 12) {
            $convertedHour .= '-' . $endHour . 'pm';
        } else {
            $convertedHour = ($convertedHour - 12) . '-' . ($endHour - 12) . 'pm';
        }

        return $convertedHour;
    }
}
