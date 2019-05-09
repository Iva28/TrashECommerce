<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    protected $fillable = [
        'user_id',
        'city',
        'address',
        'coins'
    ];
}
