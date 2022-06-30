<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageHandler extends Model
{
    protected $table = 'stage_handlers';
    protected $fillable = [
        'stage', 'posisi', 'nama', 'bread', 'next', 'reroute', 'next_label', 'reroute_label'
    ];
}
