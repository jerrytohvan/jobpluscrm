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
               <h3>Events</h3>
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

               <!-- form date pickers -->
               <div class="x_panel" style="">
                 <div class="x_title">
                   <h2>Create New Event<small> Schedule your upcoming events!</small></h2>
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


                   <div class="well" style="overflow: auto">

                     <div class="col-md-5">
                       Date and Time
                       <form class="form-horizontal">
                         <fieldset>
                           <div class="control-group">
                             <div class="controls">
                               <div class="input-prepend input-group" >
                                 <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                 <input type="text" name="reservation-time" id="reservation-time" class="form-control" value="01/01/2016 - 01/25/2016" />
                               </div>
                             </div>
                           </div>
                         </fieldset>
                       </form>
                     </div>
                   </div>


                 </div>
               </div>
               <!-- /form datepicker -->

             </div>
           </div>
           <div class="row">
             <div class="col-md-4">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Upcoming Events <small>Today</small></h2>
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
                   <article class="media event">
                     <a class="pull-left date">
                       <p class="month">April</p>
                       <p class="day">23</p>
                     </a>
                     <div class="media-body">
                       <a class="title" href="#">Item One Title</a>
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                     </div>
                   </article>
                   <article class="media event">
                     <a class="pull-left date">
                       <p class="month">April</p>
                       <p class="day">23</p>
                     </a>
                     <div class="media-body">
                       <a class="title" href="#">Item Two Title</a>
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                     </div>
                   </article>
                   <article class="media event">
                     <a class="pull-left date">
                       <p class="month">April</p>
                       <p class="day">23</p>
                     </a>
                     <div class="media-body">
                       <a class="title" href="#">Item Two Title</a>
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                     </div>
                   </article>
                   <article class="media event">
                     <a class="pull-left date">
                       <p class="month">April</p>
                       <p class="day">23</p>
                     </a>
                     <div class="media-body">
                       <a class="title" href="#">Item Two Title</a>
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                     </div>
                   </article>
                   <article class="media event">
                     <a class="pull-left date">
                       <p class="month">April</p>
                       <p class="day">23</p>
                     </a>
                     <div class="media-body">
                       <a class="title" href="#">Item Three Title</a>
                       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                     </div>
                   </article>
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

<!-- bootstrap-datetimepicker -->
<!-- <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script> -->
<!-- Ion.RangeSlider -->
<script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
<!-- jquery.inputmask -->
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<!-- jQuery Knob -->
<script src="{{ asset('js/jquery.knob.min.js') }}"></script>
<!-- Cropper -->
<script src="{{ asset('js/cropper.min.js') }}"></script>

<!--  -->
@endpush
