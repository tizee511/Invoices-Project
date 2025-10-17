<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\invoices;
class invoice_attachments extends Model
{
    protected $fillable=[
        'file_name',
        'invoice_number',
        'created_by',
        'invoice_id'
    ];

    public function invoices(){
        return $this->belongsTo(invoices::class,'invoice_id','id');
    }
}
