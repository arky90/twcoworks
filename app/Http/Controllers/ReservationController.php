<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Room;

class ReservationController extends Controller
{

  /**
   * Get all reservation for a User Id
   * @param user_id integer
   * @return \Illuminate\Http\JsonResponse  
   */
  public function getReservationByUser($userId){
    $userId = $userId ?? Auth::id();

    $reservations = Reservation::with(['room', 'status'])
      ->where('user_id', $userId)
      ->get();

    return $reservations;
  }


  public function create(Request $request){
    // Validación de los datos
    $request->validate([
      'roomNames' => 'required|integer',
      'date' => 'required|string',
      'hour' => 'required|string'
    ]);

    $id = Auth::user()->id;
    $room = $request->input('roomNames');
    $hour = $request->input('hour') . ":00:00";
    $date = date("Y-m-d", strtotime($request->input('date')));

    $exists = Reservation::where('room_id', (int)$room)
      ->where('reservation_date', $date)
      ->where('reservation_time', $hour)
      ->exists();
    var_dump($exists);
    if ($exists) {
      return redirect()->back()->with('success', 'Ya existe una reserva para esta sala en el mismo horario.');
    }

    Reservation::create([
      'user_id' => $id,
      'room_id' => (int)$room,
      'status_id' => 1,
      'reservation_date' => $date,
      'reservation_time' => $hour
    ]);

    // Redirecciona con un mensaje de éxito
    return redirect()->back()->with('success', 'Reservacion agregada exitosamente.');
  }

  /*
    * Actualiza el estado de la reserva y redirige de nuevo a la lista.
    *
    * @param \Illuminate\Http\Request $request
    * @param int $reservationId
    * @return \Illuminate\Http\RedirectResponse
    */
  public function updateStatus(Request $request, $reservationId){
  
    $request->validate([
      'status_id' => 'required|exists:statuses,id',
    ]);

    // Encontrar la reserva y actualizar el estado
    $reservation = Reservation::findOrFail($reservationId);
    $reservation->status_id = $request->status_id;
    $reservation->save();

    // Redirige de nuevo con un mensaje de éxito
    return redirect()->back()->with('success', 'El estado de la reserva se ha actualizado correctamente.');
  }

  // Delete the Reservation by Id
  public function delete($id){
    $post = Room::findOrFail($id);
    $post->delete();

    return redirect()->back()->with('success', 'El Room ha sido eliminado correctamente.');
  }
}
