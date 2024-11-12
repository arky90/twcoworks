<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use App\Models\Room;

class DashboardController extends Controller {
 
  public function __construct() {
    $this->middleware('auth');
  }

  public function index() {
    
    $hours = $this->getHourArray();
    $rooms = Room::all();
    
    $reservationController = new ReservationController();
    $reservations = $reservationController->getReservationByUser(null);
 
    return view('client.dashboard',  compact('rooms','hours', 'reservations'));
  }

  private function getHourArray():array{
    for ($i = 0; $i <= 23 ; $i++){
      $hours[] = ($i > 9) ? "$i" : "0".$i;
    }
    return $hours;
  }

}