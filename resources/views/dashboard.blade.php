@extends('layouts.dashboard')

<!-- title page-nya diisi disini (misal: Dashboard) -->
@section('title', 'Dashboard')

@section('styles')
<style>
    .carousel-caption-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-2 mb-lg-0 mb-4">
        </div>
        <div class="col-lg-12">
            <div class="card card-carousel overflow-hidden h-100 p-0">
                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner border-radius-lg h-100">
                        <div class="carousel-item h-100 active" style="position: relative;">
                            <img src="https://cat-aga.id/wp-content/uploads/2019/10/3-6.jpg" class="d-block w-100" alt="Background Image">
                            <div class="carousel-caption-overlay"></div>
                            <div class="carousel-caption d-flex align-items-center justify-content-center text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <h5 class="text-white mb-1">Ingin merasakan kenyamanan tanpa kompromi?</h5>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="position: relative;">
                            <img src="https://d2ile4x3f22snf.cloudfront.net/wp-content/uploads/sites/210/2017/11/27021004/tentrem-hotel-yogyakarta-gallery-Room-Deluxe-image01.jpg" class="d-block w-100" alt="Background Image">
                            <div class="carousel-caption-overlay"></div>
                            <div class="carousel-caption d-flex align-items-center justify-content-center text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <h5 class="text-white mb-1">Rasakan pengalaman menginap yang tak terlupakan</h5>
                            </div>
                        </div>
                        <div class="carousel-item h-100" style="position: relative;">
                            <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/283786439.jpg?k=6ccc68b23f8bf93b2087fb03cf112eee216d52a1525d598859d51330bfa180a0&o=&hp=1" class="d-block w-100" alt="Background Image">
                            <div class="carousel-caption-overlay"></div>
                            <div class="carousel-caption d-flex align-items-center justify-content-center text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                <h5 class="text-white mb-1">Pesan sekarang dan nikmati liburan yang penuh kenangan!</h5>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('scripts')
<!-- simpan js disini -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carouselInner = document.querySelector('.carousel-inner');
        carouselInner.classList.add('dark');
    });
</script>
@endsection