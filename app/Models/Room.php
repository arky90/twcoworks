<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relación con Reservation: una sala puede tener muchas reservas.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
