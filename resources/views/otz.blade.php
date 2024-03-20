@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection

@section('content')
<main>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <h1>Отзывы</h1>
            <br>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{  asset('storage/images/1/3.png') }}" alt="" max-width="100%">
                        <div class="card-body">
                            <h5 class="card-title">Коротких Юлия</h5>
                            <p class="card-text">Отзыв о сайте</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{  asset('storage/images/1/4.png') }}" alt="" max-width="100%" max-height="250">
                        <div class="card-body">
                            <h5 class="card-title">Коротких Юлия</h5>
                            <p class="card-text">Отзыв о сайте</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="{{  asset('storage/images/1/5.png') }}" alt="" max-width="100%">
                        <div class="card-body">
                            <h5 class="card-title">Коротких Юлия</h5>
                            <p class="card-text">Отзыв о сайте</p>
                            <div class="d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
                @yield('content')
</main>
@include('layouts.footer')
</body>

</html>
@endsection