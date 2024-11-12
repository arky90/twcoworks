<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\Status;

class DashboardController extends Controller {
  public function __construct() {
    $this->middleware('auth');
  }

  public function index(Request $request) {

    $idFilter = $request->input('roomNames');
  
    if($idFilter){
      $reservations = Reservation::with(['room', 'status'])
      ->where('room_id', $idFilter)
      ->get();
    }else{
      $reservations = Reservation::all();
    }

    $rooms = Room::all();
    $statuses = Status::all();

    return view('admin.dashboard',compact('rooms','reservations','statuses', 'idFilter'));
  }
}