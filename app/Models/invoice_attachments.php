<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice_attachments extends Model
{
    protected $fillable=[
        'file_name',
        'invoice_number',
        'created_by',
        'invoice_id'
    ];
}
