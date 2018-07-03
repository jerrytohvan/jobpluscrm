<!-- WILL INHERIT LAYOUT SKELETON FROM -->
@extends('layouts.master')

@section('title')
  Job Plus
@endsection

@section('content')
    <body class="login">
      <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
          <div class="animate form login_form">
            <section class="login_content">
              {!! Form::open(['route'=>['login'], 'method'=>'post']) !!}
                <h1>Login Form</h1>
                <div>
                  <input type="email" class="form-control" id="email1" name="email1" placeholder="Email" required="" />
                </div>
                <div>
                  <input type="password" id="password1" name="password1"  class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                  <a class="btn btn-default submit">Log in</a>
                  <a class="reset_pass" href="#">Lost your password?</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                  <p class="change_link">New to site?
                    <a href="#signup" class="to_register"> Create Account </a>
                  </p>

                  <div class="clearfix"></div>
                  <br />

                  <div>
                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                  </div>
                </div>
              </form>
            </section>
          </div>

          <div id="register" class="animate form registration_form">
            <section class="login_content">
                <h1>Create Account</h1>
                {!! Form::open(['route'=>['register'], 'method'=>'post']) !!}
                <div>
                  <input type="text" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                  <input type="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                  <input type="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                  <a class="btn btn-default submit">Submit</a>
                </div>
                {!! Form::close() !!}

                <div class="clearfix"></div>

                <div class="separator">
                  <p class="change_link">Already a member ?
                    <a href="#signin" class="to_register"> Log in </a>
                  </p>

                  <div class="clearfix"></div>
                  <br />

                  <div>
                    <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </body>


@endsection
