<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    //
    //Relation Many->1
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
