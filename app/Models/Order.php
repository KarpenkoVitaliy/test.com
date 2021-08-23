<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function client() {
        return $this->belongsTo("App\Models\Client");//8-1
    }

    public function employee() {
        return $this->belongsTo("App\Models\Employee");//8-1
    }
}
