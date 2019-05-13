<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property string $city
 * @property string $address
 * @property int $coins
 * @property \App\User $user
 */
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
