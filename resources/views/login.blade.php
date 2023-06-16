@extends('layouts.master')

@section('styles')
<!-- simpan css customnya disini -->
@endsection

@section('main')
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Welcome Back !</h3>
                        <p>Sign in now to continue</p>

                        @if(session('error'))
                        <div class="alert alert-danger">
                            <b>Opps!</b> {{session('error')}}
                        </div>
                        @endif

                        <form action="{{ route('login.submit') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Username">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Don't have an account? <a href="{{ url('register') }}" class="text-dark font-weight-bolder">Register</a></p>
                        </form>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<!-- simpen js nya disini -->
@endsection