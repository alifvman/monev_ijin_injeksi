<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    protected $table = 'application_documents';
    protected $fillable = [
        'ref_application_id', 'ref_document_id', 'hardcopy', 'softcopy', 'flag'
    ];
}
