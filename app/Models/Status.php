<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relación con Reservation: un estado puede ser usado por muchas reservas.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}