<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
class invoices extends Model
{
      protected $fillable = [
        'invoice_number',
        'invoice_Date',
        'due_date',
        'product',
        'section_id',
        'Amount_collection',
        'Amount_Commission',
        'discount',
        'value_vat',
        'rate_vat',
        'total',
        'status',
        'value_status',
        'note',
        'Payment_Date'

    ];
protected $dates = ['deleted_at'];

    public function sections()
    {
    return $this->belongsTo(sections::class,'section_id');
    }
    public function invoices_details()
    {
    return $this->belongsTo(invoices_details::class,'invoice_id');
    }



}
