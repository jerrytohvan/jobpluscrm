@extends('layouts.master')


@push('stylesheets')
<link href="{{ asset('css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fakeLoader.css') }}" rel="stylesheet">

<script src="{{ asset('js/fakeLoader.min.js') }}"></script>
<script src="{{ asset('js/jquery.easypiechart.min.js') }}"></script>

@endpush


@section('content')
<!-- page content -->
<div id="fakeLoader"></div>
<script>
$(window).load(function() {
  $('.right_col').hide();

  $("#fakeLoader").fakeLoader({
    timeToHide:9999999999, //Time in milliseconds for fakeLoader disappear
     zIndex:99999, // Default zIndex
      spinner:"spinner2",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
      bgColor:"#401f3e", //Hex, RGB or RGBA colors
  });

});
</script>
      <div class="right_col" role="main" style="min-height: 872px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Results - Smart Match</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Smart Match <small>Here's what we found out!</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- display resume analysis -->

                    <div class="clearfix"></div>

                    <div  id="table-list">




                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!--page content -->


@endsection



@section('bottom_content')

@endsection

@push('scripts')

<script>

  var initCharts = function() {
    var charts = $('.chart');

    $(document).ajaxComplete(function(e) {
      e.preventDefault();
      console.log('charts loaded');
      charts.each(function() {
        $(this).data('easyPieChart').update(Math.floor(100*Math.random()));
      });
    });

  }

  var chartData = [];
  var count = 0;
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrfToken"]').attr('content')
  }
  });

  $.ajax({
  type: 'POST',
  url: '/match',
      data: {
        "candidate_id": "{{ $candidate->id }}"
      },
  dataType: 'json',
  success: function(data){
        $(function() {
          var individualKeywords = data[2];
          var resumeKeywords = data[3];
          console.log(individualKeywords);
          console.log(resumeKeywords);
          for(var i=0; i<data[0].length; i++){
            var sum = 0;
            for (var j = 0; j< data[1][i].length; j++) {
              sum += data[1][i][j]
            }

            var $wrapper = $('<div class="col-md-12 col-sm-12 col-xs-12 widget_tally_box">');
            var $xpannel = $('<div class="x_panel ui-ribbon-container">')
            var $ribbon = $('<div class="ui-ribbon-wrapper">')
            $ribbon.prepend($('<div class="ui-ribbon">'+ sum +'</div>'));
            $xpannel.prepend(
              $('<div class="x_content">' +
              '<div style="text-align: center; margin-bottom: 17px">' +
              '<span class="chart" data-percent="' + Math.round(sum/resumeKeywords.length*100) + '"><span class="percent">' + Math.round(sum/resumeKeywords.length*100) + '</span></span>'
              + '</div>' + '<h3 class="name_title">' + data[0][i].job_title + '</h3>' +
              '<p>' + data[0][i]. + '</p>'
             + '<div class="divider"></div>' +
             '<h4 class="name_title">Skills:</h4><br/>'+
              + '<p>' + data[0][i].job_description+ '</p>' + '<div class="divider"></div>' + '<p>'
             + data[0][i].skills+ '</p>' + '<div class="divider"></div>' + '<p>' + "Keywords match: " + data[2][i] + '</p>' + '</div>'));
             $xpannel.prepend($('<div class="x_title">' + '<h2>#' + (count+1) + '</h2>' + '<div class="clearfix"></div>' + '</div>'));
             $xpannel.prepend($ribbon);
             $wrapper.prepend($xpannel);

             $(document.getElementById('table-list')).append($wrapper);

             $('.chart').easyPieChart({
                 animate: 3000,
                 scaleColor: true,
                 lineWidth: 10,
                 lineCap: 'square',
                 size: 110,
                 trackColor: '#e5e5e5',
                 barColor: '#32213A'
             });

            chartData.push(sum);
            count++;
         }
        });
        $('.right_col').show();
        $("#fakeLoader").remove();
        $('.chart').data('easyPieChart').enableAnimation();

  },
  error: function(msg){
        console.log('fail request');
        $("#fakeLoader").remove(); //hide fakeLoader
  }
  });


</script>
<script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>

@endpush
