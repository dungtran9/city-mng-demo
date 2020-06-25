<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public static function paginate(int $int)
    {
    }

    public function city(){
        return $this->belongsTo('App\City');
    }
}
