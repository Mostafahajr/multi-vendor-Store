<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'first_name','last_name','user_id'
        ,'birthday','gender','street_address',
        'city','state','postal_code','country',
        'locale'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
