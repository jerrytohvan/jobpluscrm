@extends('layouts.master')

@section('title')
  JobPlusCRM - Register
@endsection

@section('content')
<body class="login">
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
			{!! BootForm::open(['url' => url('/register'), 'method' => 'post']) !!}

			<h1>Create Account</h1>

			{!! BootForm::text('name', 'Name', old('name'), ['placeholder' => 'Full Name']) !!}

			{!! BootForm::email('email', 'Email', old('email'), ['placeholder' => 'Email']) !!}

			{!! BootForm::password('password', 'Password', ['placeholder' => 'Password']) !!}

			{!! BootForm::password('password_confirmation', 'Password confirmation', ['placeholder' => 'Confirmation']) !!}

      <!--2 types -> Admins & Users -->

			{!! BootForm::submit('Register', ['class' => 'btn btn-default']) !!}

			<div class="clearfix"></div>

			<div class="separator">
				<p class="change_link">Already a member ?
					<a href="{{ url('/login') }}" class="to_register"> Log in </a>
				</p>

				<div class="clearfix"></div>
				<br />

				<div>
					<h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
					<p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
				</div>
			</div>
			{!! BootForm::close() !!}
        </section>
    </div>
</div>
@endsection
