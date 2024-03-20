@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection
@section('content')
<div class="container">
    <h2 class="mt-5">Регистрация пользователя</h2>
    <form class="mt-5" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-5">
            @error('Username')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <label for="Username" class="form-label">Username</label>
            <input type="text" name="Username" class="form-control @error('Username') is-invalis @enderror" id="Username" placeholder="Username" value="{{old('Username')}}">
        </div>

        <div class="mb-3 mt-5">
            @error('password')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalis @enderror" id="password" placeholder="password" value="{{old('password')}}">
        </div>

        <div class="mb-3 mt-5">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password" value="">
        </div>

        <div class="mb-3 mt-5">
            @error('Email')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <label for="Email" class="form-label">Email</label>
            <input type="Email" name="Email" class="form-control @error('Email') is-invalis @enderror" id="Email" placeholder="Email" value="{{old('Email')}}">
        </div>

        <div class="form-group">
            <label for="UserPhoto">Avatar</label>
            <input type="file" class="form-control-file" id="UserPhoto" name="UserPhoto">
        </div>
        <button type="submit" class="btn btn-primary mt-5" sstyle="background-color: #212529; border-color: #212529">Отправить</button>
    </form>
</div>
@endsection