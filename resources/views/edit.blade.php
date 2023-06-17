@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Profile')

@section('styles')
<!-- simpan css disini -->
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="card-body p-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h4>My Profile</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', ['user' => Auth::user()->id]) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Username</label>
                                        <input class="form-control" type="email" value="{{ Auth::user()->username }}" disabled="disable">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Fullname</label>
                                        <input class="form-control" name="fullname" type="text" value="{{ Auth::user()->fullname }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" value="{{ Auth::user()->email }}" disabled="disable">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Phone Number</label>
                                        <input class="form-control" name="phone_number" type="text" value="{{ Auth::user()->phone_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">ID Card</label>
                                        <input class="form-control" name="no_ktp" type="text" value="{{ Auth::user()->no_ktp }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nationality</label>
                                        <input class="form-control" name="nationality" type="text" value="{{ Auth::user()->nationality }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <textarea class="form-control" name="address" type="area">{{ Auth::user()->address }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
    <!-- simpan js disini -->
    @endsection