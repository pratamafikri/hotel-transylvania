@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Room')

@section('styles')
<!-- simpan css disini -->
@endsection

@section('content')
<div class="container-fluid py-4">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Tambah Room</h3>
		</div>
		<form action="{{url('/room/store')}}"  method="POST">
			{{csrf_field()}}
			<div class="row card-body">
                <div class="col-4">
                    <div class="form-group">
                        <label for="room_number">Room number</label>
                        <input type="text" name="room_number" class="form-control form-control-sm" placeholder="Room Number">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="room_type">Room Type</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="room_type" id="room_type" class="custom-select rounded-0">
                            <option selected=""><label>Pilih Room Type</label></option>
                            <option value="Standard">Standard</option>
                            <option value="Deluxe">Deluxe</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="bed">Bed Type</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="bed" id="bed" class="custom-select rounded-0">
                            <option selected="">Pilih Tipe Kasur</option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" name="price" class="form-control  form-control-sm" placeholder="Harga">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select  class="form-select form-select-sm" aria-label=".form-select-sm example" name="status" id="status" class="custom-select rounded-0">
                            <option selected="">Pilih Tipe Kasur</option>
                            <option value="Available">Available</option>
                            <option value="Booked">Booked</option>
                            <option value="Under Maintenance">Under Maintenance</option>
                        </select>
                    </div>
                </div>
			</div>

            <div class="card-body row">
                <h3>Maintenance Detail</h3>
                <div class="col-4">
                    <div class="form-group">
                        <label for="maintenance_start">Maintenance Start</label>
                        <input type="datetime-local" name="maintenance_start" class="form-control form-control-sm" placeholder="Maintenance Start">
                    </div>
                    <div class="form-group">
                        <label for="maintenance_end">Maintenance End</label>
                        <input type="datetime-local" name="maintenance_end" class="form-control form-control-sm" placeholder="Maintenance End">
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