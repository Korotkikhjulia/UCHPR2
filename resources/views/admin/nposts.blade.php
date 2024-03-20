@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection

@section('content')
<main>
  <div class="album py-5 bg-body-tertiary">
    <div class="container">
        <h1>Новые посты</h1>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($Ads as $Ad)
        @if($Ad->Status == 'Ex')
        <div class="col">
          <div class="card shadow-sm">
            @if($Ad->AdPhoto!= null)
            <img src="{{ asset('storage/'.str_replace('public/', '', $Ad->AdPhoto))}}" alt="" width="100%" height="225">
            @else
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>
            @endif
            <div class="card-body">
              <h5 class="card-title">{{$Ad->Title}}</h5>
              <p class="card-text">{{$Ad->Description}}</p>
              <div class="d-flex justify-content-between align-items-center">
                @foreach ($categories as $cat2)
                @if($cat2->id==$Ad->CategoryID)
                <div class="card-cat">{{$cat2->CategoryName}}</div>
                @endif
                @endforeach
                <small class="text-body-secondary">{{$Ad->created_at}}</small>
                @if(Auth::check() && Auth::user()->Role)

                <div >
                  <form action="{{route('post.red')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" id="post" value="{{$Ad->id}}">
                    <button type="submit" class="btn btn-sm btn-outline-secondary" style="color: #212529; border-color: #212529">Редак-ть</button>
                  </form>
                  <form action="{{route('post.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" id="post" value="{{$Ad->id}}">
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="color: #2C232B; border-color: #2C232B">Удалить</button>
                  </form>
                  <form action="{{route('post.opub')}}" method="POST">
                    @csrf
                    <input type="hidden" name="post" id="post" value="{{$Ad->id}}" >
                    <button type="submit" class="btn btn-sm btn-outline-danger" style="color: #3A3D30	; border-color: #3A3D30	">Опуб-ть</button>
                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
        @endif
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