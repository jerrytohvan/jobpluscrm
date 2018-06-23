<!-- WILL INHERIT LAYOUT SKELETON FROM -->
@extends('layouts.master')

@section('title')
  Job Plus
@endsection

@section('login')
<div class="container">
  <div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">
      {!! Form::open(['route'=>['login'], 'method'=>'post']) !!}
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input class="form-control" id="email1" name="email1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input class="form-control" id="password1"  name="password1" type="password" placeholder="Password">
        </div>
        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox"> Remember Password</label>
          </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Login</button>
        {!! Form::close() !!}
      <div class="text-center">
        <!-- PRINT ANY ERROR MESSAGES (`Wrong Username/Password`)-->
        <a class="d-block small mt-3" href="{{route('register')}}">Register an Account</a>
        <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
      </div>
    </div>
  </div>
@endsection
