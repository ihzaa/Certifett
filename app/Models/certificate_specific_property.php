<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate_specific_property extends Model
{
    protected $fillable = ['id', 'nama', 'gambar', 'data', 'certificate_id'];

    public function certificate()
    {
        return $this->belongsTo('App\Models\certificate');
    }
}
