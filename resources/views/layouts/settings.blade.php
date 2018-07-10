@extends('layouts.master')

@section('content')
<!-- top tiles -->
<div class="right_col" role="main">
  <div class="row tile_count">
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
      <div class="count">2500</div>
      <span class="count_bottom"><i class="green">4% </i> From last Week</span>
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Settings</h3>
          </div>
          <div class="col-md-6">
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
              <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
              <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
            </div>
          </div>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
          <div id="chart_plot_01" class="demo-placeholder"></div>
        </div>

        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />


</div>

@endsection
