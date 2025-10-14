<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\invoices;

class invoices_details extends Model
{
    protected $fillable =[
        'id_Invoice',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'note',
        'user'
    ];
 public function invoices(){
        return $this->belongsTo(invoices::class ,'invoice_id');
    }


}
