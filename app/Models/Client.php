<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    //public $timestamps = false;

    //protected $table = "clients";//Якщо назва моделі не співпадає з назвою таблиці

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'type',
        'remember_token'
    ];

    public function orders(){
        return $this->hasMany('App\Models\Order');//1-8
    }

}
