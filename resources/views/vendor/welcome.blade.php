@extends('layouts.master')
@section('title')
  Welcome to Laravel 5!
@endsection

@section('content')
@include('includes.message-block')

  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <h3>Please Sign Up</h3>
      <form action="{{route('signup')}}" method="post">
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">

          <label for="email">Your Email</label>

          <input class="form-control" type="email" name='email' id="email" value="{{Request::old('email')}}">

        </div>

        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">

          <label for="first_name">Your First Name</label>

          <input class="form-control" type="text" name='first_name' id="first_name" value="{{Request::old('first_name')}}">

        </div>

        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">

          <label for="email">Your Password</label>

          <input class="form-control" type="password" name='password' id="password">

        </div>

        <button type="submit" class="btn btn-primary">Register</button>

        <input type="hidden" name="_token" value="{{ Session::token()}}">

      </form>

    </div>

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      <h3>Please Sign In</h3>
      <form action="{{route('signin')}}" method="post">
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">

          <label for="email">Your Email</label>

          <input class="form-control" type="email" name='email' id="email" value="{{Request::old('email')}}">

        </div>

        <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">

          <label for="email">Your Password</label>

          <input class="form-control" type="password" name='password' id="password">

        </div>

        <button type="submit" class="btn btn-primary">Sign in</button>

        <input type="hidden" name="_token" value="{{ Session::token()}}">

      </form>

    </div>
  </div>

@endsection
