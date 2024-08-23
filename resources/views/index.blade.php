@extends('main.master')

@section('filter')
    <form action="/search" method="post">
        @csrf
        <div class="col-12 btn-group mb-2" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
        </div>
        <input type="text" class="form-control mb-2" placeholder="جستجو بر اساس نام محله">
        <input type="text" class="form-control mb-2" placeholder="جستجو بر اساس شهر">
        <select class="form-select mb-2" aria-label="Default select example">
            <option selected>فیلتر بر اساس امتیاز</option>
            <option value="1">بیشترین امتیاز</option>
            <option value="2">کمترین امتیاز</option>
        </select>
        <button class="btn btn-primary col-12" type="button">Button</button>
    </form>
@endsection

@section('search')
    <div class="input-group input-group-lg mb-2">
        <form action="/search" method="post" class="input-group input-group-lg mb-2">
            @csrf
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="search">
        <button class="btn btn-outline-secondary" type="button" id="button-addon1">Button</button>
        </form>
    </div>
@endsection

@section('cards')
{{--    @php
        $places = \App\Models\Place::all();
//    @endphp--}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <!-- Home listings -->
        @foreach($places as $place)
            <div class="col">
                <div class="card h-100 text-right">
                    @foreach($place->photos as $photo)
                        <img src="{{ $photo->path }}" class="card-img-top home-image" alt="عکس محله">
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $place->type == 1 ? 'سفره خانه ' : 'قهوه خانه ' }}{{ $place->name }}</h5>
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
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-3 mb-4 order-lg-last w-12">
<nav aria-label="Page navigation example">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($places->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $places->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($places->links()->elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $places->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($places->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $places->nextPageUrl() }}" rel="next" aria-label="Next">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
</nav>
</div>
    </div>
</div>
@endsection
