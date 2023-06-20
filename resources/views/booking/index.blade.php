@extends('layouts.dashboard')

@section('title') Book @endsection()

@section('styles')
<!-- simpan css disini -->
<style>
    .room-card {
        cursor: pointer;
        transition: 0.3s;
        border-radius: 10px;
        border: 1px solid white;
    }

    .room-card:hover {
        border: 1px solid #0D6EFD;
    }

    .selected {
        border: 1px solid #0D6EFD;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Reservasi Kamar
        </div>
        <div class="card-body">
            @if(Session::has('msg'))
            <div class="alert alert-info text-white">
                {!! Session::get('msg') !!}
            </div>
            @endif

            <form action="{{route('book.create')}}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-12 col-md-4">
                        <label for="check_in_date" class="form-label">Check In:</label>
                        <input type="date" name="check_in_date" value="<?= date('Y-m-d') ?>" id="check_in_date" class="form-control">
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="check_in_date" class="form-label">Durasi:</label>
                        <select name="durasi" id="durasi" class="form-control">
                            <option selected value="1">1 Malam</option>
                            <option value="2">2 Malam</option>
                            <option value="3">3 Malam</option>
                            <option value="4">4 Malam</option>
                            <option value="5">5 Malam</option>
                            <option value="6">6 Malam</option>
                            <option value="7">7 Malam</option>
                            <option value="8">8 Malam</option>
                            <option value="9">9 Malam</option>
                            <option value="10">10 Malam</option>
                            <option value="11">11 Malam</option>
                            <option value="12">12 Malam</option>
                            <option value="13">13 Malam</option>
                            <option value="14">14 Malam</option>
                            <option value="15">15 Malam</option>
                            <option value="16">16 Malam</option>
                            <option value="17">17 Malam</option>
                            <option value="18">18 Malam</option>
                            <option value="19">19 Malam</option>
                            <option value="20">20 Malam</option>
                            <option value="21">21 Malam</option>
                            <option value="22">22 Malam</option>
                            <option value="23">23 Malam</option>
                            <option value="24">24 Malam</option>
                            <option value="25">25 Malam</option>
                            <option value="26">26 Malam</option>
                            <option value="27">27 Malam</option>
                            <option value="28">28 Malam</option>
                            <option value="29">29 Malam</option>
                            <option value="30">30 Malam</option>

                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="check_out_date" class="form-label">Check Out:</label>
                        <input type="text" name="check_out_date" id="check_out_date" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-12 col-md-6">
                        <label for="room_type" class="form-label">Tipe Kamar:</label>
                        <select name="room_type" id="room_type" class="form-control">
                            <option disabled selected value="">-- Pilih tipe kamar --</option>
                            <option value="Standard">Standard</option>
                            <option value="Premium">Premium</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="bed_type" class="form-label">Tipe Bed:</label>
                        <select name="bed_type" id="bed_type" class="form-control">
                            <option disabled selected value="">-- Pilih tipe bed --</option>
                            <option value="Single">Single</option>
                            <option value="Double">Double</option>
                            <option value="Triple">Triple</option>
                            <option value="Quad">Quad</option>
                            <option value="Queen">Queen</option>
                            <option value="King">King</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-4 gy-2" id="room_wrapper">
                </div>
                <input type="hidden" name="room_id" id="room_id">
                <input type="hidden" name="room_price" id="room_price">
                <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <input type="submit" value="Pesan" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- simpan js disini -->
<script>
    // Mendapatkan referensi elemen-elemen yang diperlukan
    var checkInDateInput = document.getElementById('check_in_date');
    var durasiSelect = document.getElementById('durasi');
    var checkOutDateInput = document.getElementById('check_out_date');

    // Event listener untuk perubahan pada check_in_date atau durasi
    checkInDateInput.addEventListener('change', updateCheckOutDate);
    durasiSelect.addEventListener('change', updateCheckOutDate);

    // Fungsi untuk memperbarui nilai check_out_date
    function updateCheckOutDate() {
        var checkInDate = new Date(checkInDateInput.value);
        var durasi = parseInt(durasiSelect.value);

        // Menghitung tanggal check out dengan menambahkan durasi ke check in
        var checkOutDate = new Date(checkInDate.getTime() + durasi * 24 * 60 * 60 * 1000);

        // Mengubah format tanggal menjadi 'YYYY-MM-DD'
        var formattedCheckOutDate = checkOutDate.toISOString().split('T')[0];

        // Memperbarui nilai check_out_date input
        checkOutDateInput.value = formattedCheckOutDate;
    }

    // Memanggil fungsi updateCheckOutDate() saat halaman pertama kali dimuat
    updateCheckOutDate();

    function selectRoomCard(room_id, room_price) {
        var cards = document.getElementsByClassName('card room-card')
        for (var i = 0; i < cards.length; i++) {
            cards[i].classList.remove("selected");
        }

        var selected_room = document.querySelector('#room_'+ room_id);
        console.log(selected_room.classList);
        selected_room.classList.add("selected")

        var input_room_id = document.getElementById('room_id')
        input_room_id.value = room_id

        var input_room_price = document.getElementById('room_price')
        input_room_price.value = room_price
    }

    document.addEventListener('DOMContentLoaded', function() {
        var roomType = document.querySelector('#room_type');
        var bedType = document.querySelector('#bed_type');
        var roomWrapper = document.getElementById('room_wrapper');

        roomType.addEventListener('change', (event) => {
            search();
        });

        bedType.addEventListener('change', (event) => {
            search();
        });

        function search() {
            roomWrapper.innerHTML = "";
            // Lakukan permintaan AJAX ke server menggunakan Fetch API
            let url = "{{ route('book.search') }}?room_type=" + encodeURIComponent(roomType.value) + "&bed_type=" + encodeURIComponent(bedType.value);
            fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                // Lakukan tindakan dengan data yang diterima dari server
                if (data.length) {
                    roomWrapper.innerHTML = '<label for="">Available Rooms:</label>';
                    Object.keys(data).forEach(key => {
                        roomWrapper.innerHTML += '<div class="col-12 col-md-3" onclick="selectRoomCard(' + data[key]['id'] + ','+ data[key]['price'] +')"><div class="card room-card" id="room_' + data[key]['id'] + '"><div class="card-body"><p class="fw-bold p-0">R. ' + data[key]['room_number'] + '</p><p class="text-end p-0 m-0">IDR ' + data[key]['price'].toLocaleString('id-ID') + '/malam</p></div></div></div>';
                    })
                }

                // roomWrapper.append()
            }).catch(function(error) {
                console.error(error);
            });
        }
    });
</script>
@endsection