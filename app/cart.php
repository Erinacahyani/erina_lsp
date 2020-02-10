<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public function products(){
        return $this->belongsTo(products::class, "produk_id");
        }
}
