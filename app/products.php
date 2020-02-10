<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    public function category(){
        return $this->belongsTo(category::class, "kategori_id");
    }
}
