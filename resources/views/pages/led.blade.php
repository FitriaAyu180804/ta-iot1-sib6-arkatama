@extends('layouts.dashboard')

@section('title_menu', 'LED Control')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <a class="nav-link" href="{{ route('led.index') }}">
                <i class="fas fa-lightbulb"></i>
                <span>LED Control</span></a>
    </li>
    <div class="card w-100">
        <div class="card-body">
            <h5 class="card-title">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus"></i>
                    Tambah LED
                </button>
            </h5>

            <div class="row my-4">
                @foreach ($leds as $led)
                    <div class="col-sm-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex w-100 justify-content-between">
                                    <div
                                        class="d-flex align-items-start
                                    @if ($led->status == '1') text-primary @endif
                                    ">
                                        <i class="fas fa-lightbulb fa-fw fa-4x"></i>
                                        <div>
                                            <h6 class="fw-bold">{{ $led->name }}</h6>
                                            <p class="text-muted">Pin: {{ $led->pin }}</p>

                                            <div class="form-check form-switch">
                                                <input @checked($led->status == '1') class="form-check-input toggle-status"
                                                    data-id="{{ $led->id }}" data-status="{{ $led->status ? 0 : 1 }}"
                                                    type="checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <i class="fas fa-ellipsis-v fa-fw" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item edit-led" href="#" data-id="{{ $led->id }}" data-name="{{ $led->name }}" data-pin="{{ $led->pin }}">Edit</a></li>
                                            <li>
                                                <form action="{{ url('/api/v1/leds/' . $led->id) }}" method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add LED Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('led.store') }}" method="POST">
                <div class="modal-content">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add LED</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">LED Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nama LED">
                        </div>

                        <div class="mb-3">
                            <label for="pin" class="form-label">LED Pin</label>
                            <input type="number" class="form-control" name="pin" id="pin" placeholder="Nama LED">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit LED Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="POST" id="editForm">
                <div class="modal-content">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit LED</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editName" class="form-label">LED Name</label>
                            <input type="text" class="form-control" name="name" id="editName" placeholder="Nama LED">
                        </div>

                        <div class="mb-3">
                            <label for="editPin" class="form-label">LED Pin</label>
                            <input type="number" class="form-control" name="pin" id="editPin" placeholder="Nama LED">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.toggle-status').click(function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                $.ajax({
                    url: '/api/v1/leds/' + id,
                    type: 'PUT',
                    data: {
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while updating the status: ' + xhr.responseText);
                    }
                });
            });

            $('.edit-led').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var pin = $(this).data('pin');

                $('#editName').val(name);
                $('#editPin').val(pin);

                $('#editForm').attr('action', '/api/v1/leds/' + id);
                $('#editModal').modal('show');
            });

            $('.delete-form').submit(function(event) {
                event.preventDefault();
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    type: 'DELETE',
                    data: form.serialize(),
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while deleting the LED: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
