<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $guarded = [];

    public function userPayment()
    {
        return $this->belongsTo(UserPayment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
