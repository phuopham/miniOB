<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'note',
        'type'
    ];

    protected $guarded = array('id');

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
