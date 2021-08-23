<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function orders(){
        return $this->hasMany('App\Models\Order');//8-1
    }

    public function user() {
        return $this->belongsTo("App\Models\User");//1-1
    }
}
