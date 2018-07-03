@extends('layouts.master')

@section('title')
  PROJECT SUKACITA - Register Account
@endsection

@section('content')
<div class="container">
  <div class="card card-register mx-auto mt-5">
    <div class="card-header">Register an Account</div>
    <div class="card-body">
      {!! Form::open(['route'=>['postsignup'], 'method'=>'post']) !!}
        <div class="form-group">
          <div class="form-row">
              <label for="name">Full name</label>
              <input class="form-control" name="name" id="name" type="text" aria-describedby="nameHelp" placeholder="Enter full name">

          </div>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6">
              <label for="password">Password</label>
              <input class="form-control" id="password" name="password" type="password" placeholder="Password">
            </div>
            <div class="col-md-6">
              <label for="confirm_password">Confirm password</label>
              <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password">
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Register</button>
        {!! Form::close() !!}
      <div class="text-center">
        <a class="d-block small mt-3" href="{{ route('/') }}">Login Page</a>
        <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
      </div>
    </div>
  </div>
@endsection
