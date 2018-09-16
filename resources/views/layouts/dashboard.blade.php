@extends('layouts.master')

@push('stylesheets')
<script src="https://unpkg.com/vue"></script>

@endpush

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
      <div class="count">0</div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Average Time to link</span>
      <div class="count">0</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
      <div class="count green">0</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
      <div class="count">0</div>
      <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Companies</span>
      <div class="count">0</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
      <div class="count">0</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
    </div>
  </div>
  <!-- /top tiles -->

    <!-- start vue -->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <h3 class="text-center title-color">Drag and Droppable Cards using Vue.Draggable Demo</h3>
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
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
    }
});
</script>
<script src="{{ asset('js/vue-app-compiled.js') }}"></script>


@endpush
