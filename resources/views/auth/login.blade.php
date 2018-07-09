@extends('layouts.master')

@section('title')
  JobPlusCRM - Login
@endsection

@section('content')
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
				{!! BootForm::open(['url' => url('/login'), 'method' => 'post']) !!}

				<h1>Login Form</h1>

				{!! BootForm::email('email', 'Email', old('email'), ['placeholder' => 'Email', 'afterInput' => '<span>test</span>'] ) !!}

				{!! BootForm::password('password', 'Password', ['placeholder' => 'Password']) !!}

				<div>
					{!! BootForm::submit('Log in', ['class' => 'btn btn-default submit']) !!}
					<a class="reset_pass" href="{{  url('/password/reset') }}">Lost your password ?</a>
				</div>

				<div class="clearfix"></div>

				<div class="separator">
					<p class="change_link">New to site?
						<a href="{{ url('/register') }}" class="to_register"> Create Account </a>
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
</div>
@endsection
