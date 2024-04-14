<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'address1',
        'address2',
        'type',
        'zipcode',
        'city',
        'province',
        'country',
        'ismain'
    ];
}
