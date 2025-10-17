<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
class products extends Model
{

    protected $fillable = ['Product_name', 'description','section_id' ];

    public function sections()
    {
        return $this->belongsTo(sections::class, 'section_id','id');
    }
}


