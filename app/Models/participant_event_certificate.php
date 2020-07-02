<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class participant_event_certificate extends Model
{
    protected $fillable = ['id', 'name', 'email', 'event_id', 'certificate_id', 'release_date', 'valid_until', 'congrat_word'];

    protected $keyType = 'string';
    public $incrementing = false;

    public function event()
    {
        return $this->belongsTo('App\Models\event');
    }

    public function certificate()
    {
        return $this->belongsTo('App\Models\certificate');
    }
}
