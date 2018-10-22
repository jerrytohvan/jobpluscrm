@extends('layouts.master')

@push('stylesheets')
<script src="https://unpkg.com/vue"></script>

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-4 col-sm-2 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i>Task Overdue</span>
      <div class="count">{{$tasksOverdue}}</div>
      <span class="count_bottom"><i class="green">>{{$overdueComparison}}%</i> From last Week</span>
    </div>
    <!-- <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Task Completed This Week</span>
      <div class="count green">{{$taskThisWeek}}</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>>{{$taskComparison}}%</i> From last Week</span>
    </div> -->
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-clock-o"></i>Completed Task YTD</span>
     <div class="count">{{$totalTaskCompletedThisYear}}</div>
     <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>></i></span>
   </div>
    <!-- <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> New Companies This Week</span>
      <div class="count">{{$leadsThisWeek}}</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>>{{$leadsComparison}}%</i> From last Week</span>
    </div> -->

     <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Companies YTD</span>
      <div class="count">{{$companiesYTD}}</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-asc"></i>></i></span>
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
        <h3 class="text-center title-color">Your Tasks</h3>
         <div class="well" id="app">
           <task-draggable :tasks-open="{{ $tasksOpen }}" :tasks-on-going="{{ $tasksOnGoing }}" :tasks-closed="{{ $tasksClosed }}"></task-draggable>
         </div> <!-- end app -->
     </div>
    </div>
    <!-- end vue -->


  <!-- start of table  -->
  <!-- page content -->


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
} );

</script>
@endpush
