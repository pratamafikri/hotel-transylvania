@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Edit Room')

@section('styles')
<!-- simpan css disini -->
@endsection

@section('content')
<div class="container-fluid py-4">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Room</h3>
		</div>
		<form  action="/room/{{$room->id}}/update"  method="POST">
            {{csrf_field()}}
			<div class="row card-body">
                <div class="col-4">
                    <div class="form-group">
                        <label for="room_number">Room number</label>
                        <input type="text" name="room_number" value="{{$room->room_number}}" class="form-control form-control-sm" placeholder="Room Number">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="room_type" id="room_type" class="custom-select rounded-0">
                            <option selected=""><label>Pilih Room Type</label></option>
                            <option value="Standard" @if(str_contains($room->room_type,'Standard' )) selected @endif>Standard</option>
                            <option value="Deluxe" @if(str_contains($room->room_type,'Deluxe' )) selected @endif>Deluxe</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="bed">Bed Type</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="bed" id="bed" class="custom-select rounded-0">
                            <option selected="">Pilih Tipe Kasur</option>
                            <option value="Single" @if(str_contains($room->bed,'Single' )) selected @endif>Single</option>
                            <option value="Double" @if(str_contains($room->bed,'Double' )) selected @endif>Double</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" value="{{$room->price}}" class="form-control  form-control-sm" placeholder="Harga">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="status" id="status" class="custom-select rounded-0">
                            <option selected="">Pilih Tipe Kasur</option>
                            <option value="available" @if(str_contains($room->status,'available' )) selected @endif>Available</option>
                            <option value="booked" @if(str_contains($room->status,'booked' )) selected @endif>Booked</option>
                            <option value="maintenance" @if(str_contains($room->status,'maintenance' )) selected @endif>Maintenance</option>
                            <option value="occupied" @if(str_contains($room->status,'occupied' )) selected @endif>Occupied</option>
                        </select>
                    </div>
                </div>
			</div>

            <div class="card-body row">
                <h3>Maintenance Detail</h3>
                <div class="col-4">
                    <div class="form-group">
                        <label for="maintenance_start">Maintenance Start</label>
                        <input type="datetime-local" name="maintenance_start"  value="{{$room->maintenance_start}}" class="form-control form-control-sm" placeholder="Maintenance Start">
                    </div>
                    <div class="form-group">
                        <label for="maintenance_end">Maintenance End</label>
                        <input type="datetime-local" name="maintenance_end"  value="{{$room->maintenance_end}}" class="form-control form-control-sm" placeholder="Maintenance End">
                    </div>
                </div>
            </div>
			<div class="d-flex justify-content-center">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
@endsection

@section('scripts')
<!-- simpan js disini -->
@endsection