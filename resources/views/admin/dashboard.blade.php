@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-6">
            <div class="card border border-info-subtle">
                <div class="card-header">{{ __('Acministracion de Rooms') }}

                </div>

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


                    <div class="mt-2">
                        <h1 class="mb-4">Lista de Rooms
                            <button onclick="resetForm()" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                                Agregar Room
                            </button>
                        </h1>


                        <div class="row">
                            @if($rooms->isEmpty())
                            <p>No hay salas creadas.</p>
                            @else
                            @foreach($rooms as $room)
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $room->name }}</h5>
                                        <p><i class="card-text">{{ $room->description }}.</i></p>

                                        <button class="btn btn-secondary mb-1" onclick="editRoomModal(this)" id="btnEdit{{$room->id}}" data-id="{{ $room->id }}" data-title="{{ $room->name }}" data-description="{{ $room->description }}">Update</button>

                                        <form action="{{ route('rooms.delete', $room->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este registro?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-warning">Eliminar</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>


                    </div>
                </div>
            </div>



        </div>

        <div class="col-lg-6">

            <div class="card border border-info-subtle">
                <div class="card-header">{{ __('Administracion de Reservas') }} 

                    <div class="mb-3">
                        <form id="formFilter" action="{{ route('admin_dashboard', true) }}" method="GET">
                        @csrf
                        <select onchange="this.form.submit()" class="form-select form-select-lg mb-3" id="roomNames" name="roomNames" aria-label=".form-select-lg example">
                        <option value="0">All Rooms</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}"  {{ $room->id == $idFilter ? 'selected' : '' }} >{{ $room->name }}</option>
                        @endforeach
                    
                        </select>
                        </form>
                    </div>

                </div>

                <div class="card-body card border border-info-subtle">

                    <table class="table table-striped">
                        <thead class="table-dark">

                            <th>Habitacion</th>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Hora</td>
                            <th>Estado</th>
                       

                        </thead>
                        <tbody>
                            @if($reservations->isEmpty())
                            <tr>
                                <td> Sin Reservaciones registradas</td>
                            </tr>
                            @else
                            @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->room->name }}</td>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->reservation_time }}</td>

                                <td>
                                    <form id="formEdit-{{$reservation->id}}" action="{{ route('reservations.updateStatus', $reservation->id) }}" method="POST">
                                        @csrf
                                        <select onchange="this.form.submit()" name="status_id" class="form-select">
                                            @foreach($statuses as $status)
                                            <option value="{{ $status->id }}" {{ $reservation->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        </form>
                                </td>
                
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>


                </div>
            </div>

        </div>

        <!-- Modal de Bootstrap para agregar Room -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Agregar Room</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para agregar Room -->
                        <form action="{{ route('rooms.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="roomName" class="form-label">Nombre del Room</label>
                                <input type="text" class="form-control" id="roomName" name="name" required>
                                <input type="hidden" id="roomId" name="id" value="0">
                            </div>
                            <div class="mb-3">
                                <label for="roomDescription" class="form-label">Descripción</label>
                                <textarea class="form-control" id="roomDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar Room</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    function editRoomModal(event) {
        const myModal = new bootstrap.Modal(document.getElementById('addRoomModal'));

        const id = event.getAttribute('data-id');
        const title = event.getAttribute('data-title');
        const content = event.getAttribute('data-description');

        // Rellenar los campos del modal
        document.getElementById('roomId').value = id;
        document.getElementById('roomName').value = title;
        document.getElementById('roomDescription').textContent = content;

        myModal.show(); // Abre el modal
    }

    function resetForm() {
        document.getElementById('roomId').value = "";
    }
</script>
@endsection