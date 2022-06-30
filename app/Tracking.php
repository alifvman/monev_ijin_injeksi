<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'trackings';
    protected $fillable = [
        'permohonan_id', 'stage', 'note'
    ];

    public function peran()
    {
        return $this->hasOneThrough(
            'App\Peran',
            'App\StageHandler',
            'stage',
            'posisi',
            'stage',
            'posisi'
        );
    }
}
