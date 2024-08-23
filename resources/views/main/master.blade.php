<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('addtohead')

    <!-- Bootstrap CSS -->
    <link href="{{ asset('dist/css/bootstrap.rtl.css') }}" rel="stylesheet">
    <script src="{{ asset('dist/js/bootstrap.js') }}"></script>

    <title>صفحه اصلی - لیست سفرهای خانه</title>
    <style>
        .home-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        /* Custom styles for responsive carousel */
        @media (max-width: 576px) {
            .carousel-item img {
                width: 100%;
                height: 300px;
                object-fit: cover;
            }
        }

        @media (min-width: 577px) and (max-width: 768px) {
            .carousel-item img {
                width: 100%;
                height: 400px;
                object-fit: cover;
            }
        }

        @media (min-width: 769px) and (max-width: 1200px) {
            .carousel-item img {
                width: 100%;
                height: 600px;
                object-fit: cover;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
{{--<!-- Slider -->
<div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="اسلاید ۱">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="اسلاید ۲">
        </div>
        <div class="carousel-item">
            <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="اسلاید ۳">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">قبلی</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">بعدی</span>
    </button>
</div>--}}

<!-- Search and Filter -->
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 mb-4 order-lg-last">
            @yield('filter')
        </div>
        <div class="col-lg-9">
            @yield('search')
            @yield('cards')
            @yield('content')
            @yield('map')
            @yield('showonmap')
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; ۲۰۲۴ - تمامی حقوق محفوظ است.
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
