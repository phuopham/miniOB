<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'ship',
        'products',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
