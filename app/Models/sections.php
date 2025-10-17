<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class sections extends Model
{

    protected $fillable = ['section_name', 'description','created_by'];

    // public function products()
    // {
    //     return $this->hasMany(products::class, 'section_id');
    // }
    // public function invoices()
    // {
    // return $this->belongsTo(invoices::class,'section_id');
    // }



}
