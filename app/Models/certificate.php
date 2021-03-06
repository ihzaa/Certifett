<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    protected $fillable = ['nama_instansi', 'jenis_sertifikat', 'logo_instansi', 'logo_sertifikat', 'alasan'];

    public function specific_properties()
    {
        return $this->hasMany('App\Models\certificate_specific_property');
    }

    public function event()
    {
        return $this->hasOne('App\Models\event');
    }

    public function participant_event()
    {
        return $this->hasMany('App\Models\participant_event_certificate');
    }
}
