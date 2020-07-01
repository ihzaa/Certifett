<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['name', 'date', 'capacity', 'user_owner', 'receipt_id', 'certificate_id'];

    public function owner()
    {
        return $this->belongsTo('App\User','user_owner');
    }

    public function receipt()
    {
        return $this->belongsTo('App\Models\receipt');
    }

    public function certificate()
    {
        return $this->belongsTo('App\Models\certificate');
    }

    public function participant_event()
    {
        return $this->hasMany('App\Models\participant_event_certificate');
    }
}
