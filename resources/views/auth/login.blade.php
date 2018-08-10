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
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

				<div>
					{!! BootForm::submit('Log in', ['class' => 'btn btn-default submit']) !!}
					<a class="reset_pass" href="{{  url('/password/reset') }}">Lost your password ?</a>
				</div>

				<div class="clearfix"></div>

				<div class="separator">
					<!-- <p class="change_link">New to site?
						<a href="{{ url('/register') }}" class="to_register"> Create Account </a>
					</p> -->

					<div class="clearfix"></div>
					<br />

					<div>
						<h1><i class="fa fa-odnoklassniki"></i> JobPlus </h1>
						<p>©2018 All Rights Reserved. Artwork by <a href="https://http://jobplus.sg/">JobPlus</a></p>
					</div>
				</div>
				{!! BootForm::close() !!}
            </section>
        </div>
    </div>
</div>
@endsection
