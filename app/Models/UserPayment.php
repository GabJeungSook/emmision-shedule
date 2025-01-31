<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
