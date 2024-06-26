<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo extends Model
{
    use HasFactory;
    protected $fillable=[
        'year'
        ,'empresas'
    ];

    public function vehiculos()
    {
        return $this->hasMany(vehiculo::class);
    }
}
