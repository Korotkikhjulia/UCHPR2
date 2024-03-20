@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection
@section('content')
<div class="container">
    <div class="mt-5">
        <h1>Создать пост</h1>
    </div>
    <form class="mt-5" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-5">
            @error('CategoryID')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <select class="form-select mb-3" id="CategoryID" name="CategoryID">
                <option selected>Выберите категорию</option>
                @foreach ($categories as $key => $value)
                <option value="{{ $key }}" @if(old('CategoryID')==$key) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
            <div class="mb-3">
                @error('Title')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label for="title" class="form-label">Title</label>
                <input type="text" name="Title" class="form-control" id="Title" placeholder="Title" value="{{old('Title')}}">
            </div>
            <div class="mb-3">
                @error('Description')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control" name="Description" id="Description" rows="5">{{old('Description')}}</textarea>
            </div>
            <div class="form-group">
                @error('AdPhoto')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <label for="picture">AdPhoto</label>
                <input type="file" class="form-control-file" id="AdPhoto" name="AdPhoto">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #212529; border-color: #212529">Отправить</button>
    </form>
</div>
@endsection