@extends('layouts.master')

@push('stylesheets')
<!-- bootstrap-datetimepicker -->
<!-- <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"> -->
<!-- Ion.RangeSlider -->
<link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
<link href="{{ asset('css/ion.rangeSlider.css') }}" rel="stylesheet">
<link href="{{ asset('css/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
<link href="{{ asset('css/cropper.min.css') }}" rel="stylesheet">
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>

@endpush


@section('content')
<!-- page content -->
       <div class="right_col" role="main">
         <div class="">
           <div class="page-title">
             <div class="title_left">
               <h3>Tasks</h3>
             </div>

             <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 <div class="input-group">
                   <input type="text" class="form-control" placeholder="Search for...">
                   <span class="input-group-btn">
                     <button class="btn btn-default" type="button">Go!</button>
                   </span>
                 </div>
               </div>
             </div>
           </div>

           <div class="clearfix"></div>
           <div class="row">
             <div class="col-md-12">

               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                   <div class="x_title">
                     <h2>Add New Task <small>Fill Task Details</small></h2>
                     <ul class="nav navbar-right panel_toolbox">
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                       </li>

                       <li><a class="close-link"><i class="fa fa-close"></i></a>
                       </li>
                     </ul>
                     <div class="clearfix"></div>
                   </div>
                   <div class="x_content">
                     <br />
                     <!-- <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"> -->

                     {{  Form::open(['route' => 'add.tasks','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Task Name <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="title" name = "title" required="required" class="form-control col-md-7 col-xs-12">
                         </div>
                       </div>

                       <div class="form-group">
                         <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="required">*</span></label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="description" class="form-control col-md-7 col-xs-12" type="text" name="description" required="required">
                         </div>
                       </div>

                       <div class="form-group">
                         <label for="type" class="control-label col-md-3 col-sm-3 col-xs-12">Type </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <div id="type" class="btn-group" data-toggle="buttons">
                             <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                               <input type="radio" name="type" value="1"> &nbsp; Task &nbsp;
                             </label>
                             <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                               <input type="radio" name="type" value="0"> Event
                             </label>
                           </div>
                         </div>
                       </div>

                       <!-- <div class="form-group">
                         <label for="assigned_id" class="control-label col-md-3 col-sm-3 col-xs-12">Email </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="assigned_id" class="form-control col-md-7 col-xs-12" type="text" name="assigned_id">
                         </div>
                       </div> -->

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assigned_id">Assign Personel</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="assigned_id" id="assigned_id" tabindex="-1">
                          <option value=''>Select a Personel</option>
                            @foreach($users as $user)
                            <option value='{{ $user->id }}'>{{ $user->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_id">Company</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select class="select2_single form-control"  required='required' name="company_id" id="company_id" tabindex="-1">
                           <option value=''>Select a Company</option>
                            @foreach($companies as $company)
                            <option value='{{ $company->id }}'>{{ $company->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>


                       <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Date and Time <span class="required">*</span>
                         </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                               <div class="control-group">
                                 <div class="controls">
                                   <div class="input-prepend input-group" >
                                     <!-- <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> -->
                                     <input type="datetime-local" name="date_reminder" id="date_reminder" required="required" class="form-control" value="" />
                                   </div>
                                 </div>
                               </div>
                            </div>
                        </div>
                       <div class="ln_solid"></div>
                       <div class="form-group">
                         <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           {{ Form::submit('Submit', ['class'=>'btn btn-success']) }}
                         </div>
                       </div>
                       {!! Form::close() !!}

                     <!-- </form> -->
                   </div>
                 </div>
               </div>
             </div>
           </div>


         </div>
       </div>
       <!-- /page content -->

@endsection


@section('bottom_content')
      <input type="hidden" class="btn btn-primary" id="download" href="javascript:void(0);" ></a>
@endsection

@push('scripts')

<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>
r
<script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
<!-- jquery.inputmask -->
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<!-- jQuery Knob -->
<script src="{{ asset('js/jquery.knob.min.js') }}"></script>
<!-- Cropper -->
<script src="{{ asset('js/cropper.min.js') }}"></script>

<!--  -->
@endpush
