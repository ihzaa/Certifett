<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    protected $fillable = ['amount', 'amount_paid', 'via'];

    public function event()
    {
        return $this->hasOne('App\Models\event');
    }
}
