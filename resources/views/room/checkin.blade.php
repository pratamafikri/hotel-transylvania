@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Check In')

@section('styles')
<!-- simpan css disini -->
@endsection

@section('content')
<div class="container-fluid py-4">
	<div class="card card-primary">
		<div class="card-header">
			<h4 class="card-title">Check In/Out</h4>
		</div>
        <form method="GET" action="{{url('/room/checkin')}}" >
            <div class="card-body">
                @if(Session::has('msg'))
                <div class="alert alert-info text-white">
                    {!! Session::get('msg') !!}
                </div>
                @endif
                <center><div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" name="reservation_code" @if(isset($reservation)) value="{{ $reservation[0]->reservation_code}}" @endif class="form-control" placeholder="Cari Kode Reservasi">
                    </div>
                </div></center>
            </div>
        </form>
        @if(isset($reservation))
            <form method="POST" action="/room/{{$reservation[0]->id}}/update_checkin/" >
                {{csrf_field()}}
                <div class=" row card-body">
                    
                    <input type="hidden" name="room_id" value="{{$reservation[0]->room_id}}">
                    <input type="hidden" name="user_id" value="{{$reservation[0]->user_id}}">
                    <input type="hidden" name="reservation_id" value="{{$reservation[0]->id}}">
                    <input type="hidden" name="reservation_code" value="{{$reservation[0]->reservation_code}}">
                    <h5>User</h5>
                    @foreach($user as $user)
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Username</label>
                                <input class="form-control" name="username" type="email" value="{{$user->username }}" disabled="disable">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Fullname</label>
                                <input class="form-control" name="fullname" type="text" value="{{$user->fullname }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email</label>
                                <input class="form-control" name="email" type="email" value="{{$user->email }}" disabled="disable">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Phone Number</label>
                                <input class="form-control" name="phone_number" type="text" value="{{$user->phone_number }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">ID Card</label>
                                <input class="form-control" name="no_ktp" type="text" value="{{$user->no_ktp }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nationality</label>
                                <input class="form-control" name="nationality" type="text" value="{{$user->nationality }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <textarea class="form-control" name="address" type="area">{{$user->address }}</textarea>
                            </div>
                        </div>
                    @endforeach

                    @foreach($room as $room)
                        <h5 class="mt-3">Reservasi</h5>
                        @foreach($reservation as $reservation)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Check In</label>
                                    <input class="form-control" type="email" name="check_in_date" value="{{$reservation->check_in_date }}" disabled="disable">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Check Out</label>
                                    <input class="form-control" type="datetime-local" name="check_out_date" value="{{$reservation->check_out_date }}" @if(!str_contains($room->status,'occupied' )) disabled @endif >
                                    <input class="form-control" type="hidden" name="check_out_date_before" value="{{$reservation->check_out_date }}" >
                                </div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Number Of Days</label>
                                    <input class="form-control" type="email" name="number_of_days" value="{{$reservation->number_of_days }}" disabled="disable">
                                </div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Total</label>
                                    <input class="form-control" type="email" name="total_amount" value="{{$reservation->total_amount }}" disabled="disable">
                                </div>
                            </div>
                        @endforeach

                        <h5 class="mt-3">Room <span class="text-danger">({{$room->status}})</span></h5>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="room_number">Room number</label>
                                <input  disabled="disable" type="text" name="room_number" value="{{$room->room_number}}" class="form-control form-control-sm" placeholder="Room Number">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="room_type">Room Type</label>
                                <select  disabled="disable"  class="form-select form-select-sm" aria-label=".form-select-sm example" name="room_type" id="room_type" class="custom-select rounded-0">
                                    <option selected=""><label>Pilih Room Type</label></option>
                                    <option value="Standard" @if(str_contains($room->room_type,'Standard' )) selected @endif>Standard</option>
                                    <option value="Deluxe" @if(str_contains($room->room_type,'Deluxe' )) selected @endif>Deluxe</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="bed">Bed Type</label>
                                <select  disabled="disable"  class="form-select form-select-sm" aria-label=".form-select-sm example" name="bed" id="bed" class="custom-select rounded-0">
                                    <option selected="">Pilih Tipe Kasur</option>
                                    <option value="Single" @if(str_contains($room->bed,'Single' )) selected @endif>Single</option>
                                    <option value="Double" @if(str_contains($room->bed,'Double' )) selected @endif>Double</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex justify-content-center w-full items-center">
                            @if(str_contains($room->status,'booked' ))
                                <button class="btn btn-primary">
                                    Check In
                                </button>
                            @elseif(str_contains($room->status,'occupied' ))
                                <button class="btn btn-primary">
                                    Check Out
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                
            </form>
        @endif
	</div>
</div>
@endsection

@section('scripts')
<!-- simpan js disini -->
@endsection