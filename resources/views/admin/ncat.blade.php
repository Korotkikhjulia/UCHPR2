@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection
@section('content')
<div class="container">
    <div class="mt-5">
        <h1>Новые категории</h1>
    </div>
    <form class="mt-5" action="{{route('ncatt')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-5">
            @error('CategoryID')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <select class="form-select mb-3" id="CategoryID" name="CategoryID">
                <option selected>Имеющиеся категории</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @if(old('Cat')==$cat) selected @endif>{{ $cat->CategoryName }}</option>
                @endforeach
            </select>
            <div class="mb-3">
                @error('ncat')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label for="title" class="form-label">Новая категория</label>
                <input type="text" name="ncat" class="form-control" id="ncat" placeholder="Новая категория" value="">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #3A3D30; border-color: #3A3D30">Отправить</button>
    </form>
</div>
@endsection