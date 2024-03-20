@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection
@section('content')
<div class="container">
    <h2 class="mt-5">Авторизация пользователя</h2>
    <div class="mt-5">
    </div>
    <form class="mt-5" action="{{route('login.store')}}" method="POST">
        @csrf
        <div class="mb-3 mt-5">
            @error('Email')
                <div class = "alert alert-danger">{{$message}}</div>
            @enderror
            <label for="Email" class="form-label">Email</label>
            <input type="Email" name="Email" class="form-control @error('Email') is-invalis @enderror" id="Email" placeholder="Email" value="{{old('Email')}}">
        </div>

        <div class="mb-3 mt-5">
            @error('password')
                <div class = "alert alert-danger">{{$message}}</div>
            @enderror
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalis @enderror" id="password" placeholder="password" value="{{old('password')}}">
        </div>
        <button type="submit" class="btn btn-primary mt-5" style="background-color: #212529; border-color: #212529">Отправить</button>
    </form>
</div>
@endsection

