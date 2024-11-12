@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

    <div class="col-md-4">
        <div class="card border border-info-subtle">
            <div class="card-header">Creacion de Reservas </div>

            <div class="card-body card border border-info-subtle">

                <!-- Mensajes de éxito o error -->
                @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('reservations.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="roomNames" class="form-label">Seleccionar Room</label>
                                <select class="form-select form-select-lg mb-3" id="roomNames" name="roomNames" aria-label=".form-select-lg example">
                                @if($rooms->isEmpty())
                                <option selected>Open this select menu</option>
                                @else
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Selecciona una fecha:</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" placeholder="Selecciona una fecha">
                            </div>
                            <div class="mb-3">
                                <label for="hour" class="form-label">Seleccionar Hora</label>
                                <select class="form-select form-select-lg mb-3" id="hour" name="hour" aria-label=".form-select-lg example">
                                @foreach($hours as $hour)
                                    <option value="{{ $hour }}">{{ $hour }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                
                                <button type="submit" class="btn btn-primary">Crear Reserva</button>
                            </div>
                </form>





            </div>
        </div>
    </div>
    

    <div class="col-md-7">
        <div class="card border border-info-subtle">
            <div class="card-header">{{ __('Acministracion de Reservas') }} Role: {{ Auth::user()->role }} </div>

            <div class="card-body card border border-info-subtle">

                <table class="table table-striped">
                    <thead class="table-dark">

                        <th>Habitacion</th>
                        <th>Fecha</th>
                        <th>Hora</td>
                        <th>Estado</th>


                    </thead>
                    <tbody>
                        @if($reservations->isEmpty())
                             <tr><td> Sin Reservaciones registradas</td></tr>
                        @else
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->reservation_time }}</td>
                                <td>
                                    <span class="badge @if($reservation->status_id == 1) bg-secondary
                                            @elseif($reservation->status_id == 2) bg-success
                                            @elseif($reservation->status_id == 3) bg-danger
                                            @endif">{{ $reservation->status->name }}</span>
                                </td>
                            </tr>  
                            @endforeach
                        @endif
 
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
</div>
<script>
 
</script>
@endsection