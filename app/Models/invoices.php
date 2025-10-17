<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;

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
    return $this->belongsTo(sections::class,'section_id','id');
    }



}
