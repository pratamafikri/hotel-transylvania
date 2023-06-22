@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Room')

@section('styles')
<!-- simpan css disini -->
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 flex">
                    <h6>Room</h6>
                    <a class="btn btn-link bg-primary rounded-3 text-secondary mb-0" href="{{ url('room/create') }}">
                        <span class="text-white pr-4">Tambah Room</span>
                        <i class="fa fa-arrow-right text-white pl-4"></i>
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive px-3">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Room Type</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bed</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Maintenance Start</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Maintenance End</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room as $room)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->room_number}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->room_type}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->bed}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->price}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->status}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->maintenance_start}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{$room->maintenance_end}}</p>
                                        </td>
                                        <td class="">
                                            <a href="/room/{{$room->id}}/edit" class="btn btn-facebook rounded-circle">
                                                <i class="fa fa-pen"></i>
                                            </a>
                                            <a href="/room/{{$room->id}}/delete" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-warning rounded-circle">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- simpan js disini -->
@endsection