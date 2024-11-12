<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'status_id',
        'reservation_date',
        'reservation_time'
    ];

    /**
     * Relación con User: una reserva pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con Room: una reserva pertenece a una sala.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relación con Status: una reserva tiene un estado.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}