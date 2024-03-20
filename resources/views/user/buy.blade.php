@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection

@section('content')
<main>
  <div class="album py-5 bg-body-tertiary">
    <div class="container">
        <h1>Пост создал</h1>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($Ads as $Ad)
        <div class="col">
          <div class="card shadow-sm">
            @if($Ad->UserPhoto!= null)
            <img src="{{ asset('storage/'.str_replace('public/', '', $Ad->UserPhoto))}}" alt="" width="100%" height="225">
            @else
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>
            @endif
            <div class="card-body">
                {{$Ad->id}}
              <h5 class="card-title">{{$Ad->Username}}</h5>
              <p class="card-text">{{$Ad->Email}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-body-secondary">{{$Ad->created_at}}</small>
                <div class="btn-group">
                  <form action="{{route('cart.buy')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" id="post" value="{{$Ad->id}}">
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="color: #2C232B; border-color: #2C232B">
                      <img src="{{  asset('storage/images/1/10.png') }}" alt="" height="20">
                    </button>
                  </form>
                  <form action="{{route('cart.del')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" id="post" value="{{$Ad->id}}">
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="color: #2C232B; border-color: #2C232B; margin-left:5px">
                      <img src="{{  asset('storage/images/1/9.png') }}" alt="" height="20">
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <div class='col-md-12'>
          {{$Ads->appends(['test'=>request()->test])->links('vendor.pagination.bootstrap-4')}}
        </div>
        @yield('content')
</main>
@include('layouts.footer')
</body>

</html>
@endsection