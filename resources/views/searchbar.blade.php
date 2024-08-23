@extends('main.master')
@section('search')
    <div class="input-group input-group-lg mb-2">
        <form action="/searchbar" method="post" class="input-group input-group-lg mb-2">
            @csrf
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="search">
            <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button>
        </form>
    </div>
@endsection
@section('cards')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Home listings -->
        @foreach($places as $place)
            <div class="col">
                <div class="card h-100 text-right">
                    <img src="https://via.placeholder.com/800x600" class="card-img-top home-image" alt="عکس محله">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $place->name }}</h5>
                        <div class="text-center mb-3">
                            <span class="text-muted">امتیاز کلی: </span>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="card-text text-muted text-center">تعداد امتیاز‌دهندگان: 100 نفر</p>
                        <form method="post" action="/view/{{ $place->id }}">
                            @csrf
                            <button href="#" class="btn btn-primary d-block mx-auto">نمایش اطلاعات</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
