<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Application extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachment');
    }

    public function userPayment()
    {
        return $this->hasOne(UserPayment::class);
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
