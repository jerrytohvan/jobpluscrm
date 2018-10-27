@extends('layouts.master')

@push('stylesheets')
<script src="https://unpkg.com/vue"></script>

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
<style>
/* .ui-pnotify.custom .ui-pnotify-container {
background-color: #32213A !important;
background-image: none !important;
border: none !important;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
}
.ui-pnotify.custom .ui-pnotify-title, .ui-pnotify.custom .ui-pnotify-text {
font-family: Arial, Helvetica, sans-serif !important;
text-shadow: 2px 2px 3px black !important;
font-size: 10pt !important;
color: #FFF !important;
padding-left: 50px !important;
line-height: 1 !important;
text-rendering: geometricPrecision !important;
}
.ui-pnotify.custom .ui-pnotify-title {
font-weight: bold;
}
.ui-pnotify.custom .ui-pnotify-icon {
float: left;
}
.ui-pnotify.custom .fa {
margin: 3px;
width: 33px;
height: 33px;
font-size: 33px;
color: #FF0;
} */
</style>
@endpush

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Task(s) Overdue </span>
      <div class="count">{{$tasksOverdue}}</div>
      <span class="count_bottom">
        @if(is_string($overdueComparison))
        <i><i>

        @elseif ($overdueComparison < 0)
        <i class="green"><i class="fa fa-sort-desc">
          @elseif($overdueComparison > 0)
        <i class="red"><i class="fa fa-sort-asc">
        @endif  </i> {{ is_string($overdueComparison) || $overdueComparison > 0  ? $overdueComparison: $overdueComparison  * -1 }}%</i> From Last Week</span>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-clock-o"></i> Completed Task(s) YTD</span>
     <div class="count"> {{$totalTaskCompletedThisYear }}</div>
     <span class="count_bottom">
       <!-- <i class="green"><i class="fa fa-sort-desc"></i></i> -->
     </span>
   </div>
    <!-- <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> New Companies This Week</span>
      <div class="count">{{$leadsThisWeek}}</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>>{{$leadsComparison}}%</i> From last Week</span>
    </div> -->

     <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Companies YTD</span>
      <div class="count"> {{$companiesYTD}}</div>
      <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-asc"></i></i></span> -->
    </div>
    <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
      <div class="count">5</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
  </div>  -->
  <!-- /top tiles-->

    <!-- start vue -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="well" id="app">
           <task-draggable :tasks-open="{{ $tasksOpen }}" :tasks-on-going="{{ $tasksOnGoing }}" :tasks-closed="{{ $tasksClosed }}"></task-draggable>
         </div> <!-- end app -->
     </div>
    </div>
    <!-- end vue -->


  <!-- start of table  -->
  <!-- page content -->
</div>

         <div class="clearfix"></div>


    </div>




      <div>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection

@push('scripts')

<script src="{{ asset('js/vue-app-compiled.js') }}"></script>
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>

<script>
$(document).ready(function() {
    $('.ui-pnotify').remove();
    var announcement = "{{ $announcementMsg }}";

    if( announcement != ""){
      new PNotify({
          title: "Welcome to JobPlusPlus",
          text: `<strong>Here's your latest announcement:</strong><br/>` + announcement,
          // addclass: 'custom',
          styling: 'bootstrap3',
          type:'info',
          nonblock: {
              nonblock: true
          },
          buttons: {
             show_on_nonblock: true
          },
          desktop: {
           desktop: true
       }
   });
    }
} );


function loadNotification(){
  var message = "{{ $message }}";
  var status = "{{ $status }}";

  if(message != "" && status != ""){
    new PNotify({
        title: (status == 1 ? "Success!" : "Failed!"),
        text: message,
        type: (status == 1 ? "success" : "error"),
        styling: 'bootstrap3'
    });
  }

}
</script>
@endpush
