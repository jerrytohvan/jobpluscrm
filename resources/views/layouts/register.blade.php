@if(Auth::user()->admin == 1)
@extends('layouts.master')

@push('stylesheets')
<!-- bwysiwyg -->
<link href="{{ asset('css/prettify.min.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<!-- Switchery -->
<link href="{{ asset('css/switchery.min.css') }}" rel="stylesheet">
<!-- starrr -->
<link href="{{ asset('css/starrr.css') }}" rel="stylesheet">


@endpush


@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Register Admin</h3>
      </div>


    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Create New Admin <small>Fill in the particulars below</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            {{  Form::open(['route' => 'new.admin','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Full Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="repeat-password">Confirm Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="repeat-password"  data-parsley-equalto="#password" name="repeat-password" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Admin Type</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div id="admin" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="admin" value="1"> &nbsp; Admin &nbsp;
                    </label>
                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="admin" value="0"> User
                    </label>
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="reset">Reset</button>
                  {{ Form::submit('Submit', ['class'=>'btn btn-success']) }}

                </div>
              </div>

          {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection


@section('bottom_content')

@endsection

@push('scripts')
<!-- Switchery -->
<script src="{{ asset('js/switchery.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>
<!-- Autosize -->
<script src="{{ asset('js/autosize.min.js') }}"></script>
<!-- jQuery autocomplete -->
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<!-- starrr -->
<script src="{{ asset('js/starrr.js') }}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('js/prettify.js') }}"></script>

@endpush

@else
@php abort(404) @endphp

@endif
