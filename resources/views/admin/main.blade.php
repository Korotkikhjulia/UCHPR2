@extends('layouts.layout')
@section('title')
@parent - {{$title}}
@endsection

@section('content')
<div class="container">
  <h1>Main</h1>
  <div style="width:100px">
    <table class="table table-striped">
      <tr>
        <td>id</td>
        <td>Username</td>
        <td>password</td>
        <td>Email</td>
        <td>UserPhoto</td>
        <td>Role</td>
        <td>created_at</td>
        <td>updated_at</td>
        <td>Забанить</td>
        <td>Разбанить</td>

      </tr>
      @foreach ($users as $user)
      <tr>
        <td style="max-width: 100px; overflow: auto;">{{$user->id}}</td>
        <td style="max-width: 200px; overflow: auto;">{{$user->Username}}</td>
        <td style="max-width: 250px; overflow: auto;">{{$user->password}}</td>
        <td style="max-width: 200px; overflow: auto;"> {{$user->Email}}</td>
        <td style="max-width: 250px; overflow: auto;">{{$user->UserPhoto}}</td>
        <td style="max-width: 100px; overflow: auto;">{{$user->Role}}</td>
        <td style="max-width: 100px; overflow: auto;">{{$user->created_at }}</td>
        <td style="max-width: 100px; overflow: auto;">{{$user->updated_at }}</td>
        <td style="max-width: 100px; overflow: auto;">
          <form action="{{route('user.ban')}}" method="POST">
            @csrf
            <input type="hidden" name="us" id="us" value="{{$user->id}}">
            <button type="submit" class="btn btn-sm btn-outline-danger" style="color: #2C232B; border-color: #2C232B">Забанить</button>
          </form>
        </td>
        <td style="max-width: 100px; overflow: auto;">
        <form action="{{route('user.rasban')}}" method="POST">
            @csrf
            <input type="hidden" name="us" id="us" value="{{$user->id}}">
            <button type="submit" class="btn btn-sm btn-outline-secondary" style="color: #3A3D30; border-color: #3A3D30">Разбанить</button>
          </form></td>

      </tr>
      @endforeach
    </table>
  </div>

</div>
@include('layouts.footer')
@endsection