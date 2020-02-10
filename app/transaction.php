<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public function user(){
        return $this->belongsTo("\Admin\user", 'user_id');
    }
}
