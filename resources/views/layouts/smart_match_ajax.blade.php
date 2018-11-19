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
                <h3>Smart Match - Candidate Profile</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div  class="col-md-12 col-xs-12">
                <div class="bs-example" data-example-id="simple-jumbotron">
                <div class="jumbotron">
                  <h1>{{ $candidate->name }}</h1>
                  <h5>Title</h5><p style="font-size: 14px;"> {{ $candidate->title }}</p>
                  <h5>Gender</h5><p style="font-size: 14px;"> {{ $candidate->gender }}</p>
                  <h5>Email</h5><p style="font-size: 14px;"> {{ $candidate->email }}</p>
                  <h5>Handphone</h5><p style="font-size: 14px;"> {{ $candidate->handphone }}</p>
                  <h5>Industry Interest</h5><p style="font-size: 14px;"> {{ $candidate->industry }}</p>
                  <h5>Resume Keywords</h5><p style="font-size: 14px;"> {{ implode(", ",$keywords)  }}</p>
                  <h5>Download Resume</h5>
                  @php
                    $resume = $candidate->files->first();
                  @endphp
                  <a href="{{ route('get.resume', ['file'=> $resume->id])}}"><i class="
                     @php
                     switch ($resume->file_type) {
                       case 'jpg':
                       case 'jpeg':
                       case 'png':
                       echo 'fa fa-picture-o';
                       break;
                       case 'pdf':
                       echo 'fa fa-file-pdf-o';
                       break;
                       case 'xls':
                       case 'xlsx':
                       case 'xltm':
                       case 'xlsm':
                       case 'csv':
                       echo 'fa fa-file-excel-o';
                       break;
                       case 'ppt':
                       case 'pptx':
                       echo 'fa fa-file-powerpoint-o';
                       break;
                       case 'doc':
                       case 'docx':
                       echo 'fa fa-file-word-o';
                       break;
                       case 'zip':
                       case 'rar':
                       case '7z':
                       echo 'fa fa-file-archive-o';
                       break;
                       default:
                       echo 'fa fa-folder';
                     }
                     @endphp"></i>{{ $resume->file_name }}</a>

                </div>
              </div>
              </div>
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Smart Match - Results <small>Here's what we found out!</small></h2>
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
          for(var i=0; i<data[0].length; i++){
            var keywordsConcat = data[3][i];
            var blkstr = [];
              $.each(keywordsConcat, function(idx2,val2) {
                blkstr.push(val2);
              });

            var $wrapper = $('<div class="col-md-12 col-sm-12 col-xs-12 widget_tally_box">');
            var $xpannel = $('<div class="x_panel ui-ribbon-container">');
            var $ribbon = $('<div class="ui-ribbon-wrapper">');
            // $ribbon.prepend($('<div class="ui-ribbon">'+ Math.round(data[1][i].reduce((a, b) => a + b, 0)) +' Points</div>'));

            // <div class="bs-example" data-example-id="simple-jumbotron">
            //       <div class="jumbotron">
            //         <h1>Number</h1>
            //         <p>Keyword(s) Matched</p>
            //       </div>
            //     </div>
            // '<span class="chart" data-percent="' + Math.round(data[2][i]) + '"><span class="percent">' + Math.round(data[2][i]) + '</span></span>'

            $xpannel.prepend(
              $('<div class="x_content">' +
              '<div style="text-align: center; margin-bottom: 17px">' 
              + '</div>' + '<h3 class="name_title">' + data[0][i].job_title + '</h3>' +
              '<div class="bs-example" data-example-id="simple-jumbotron"><div class="jumbotron"><h1>' +
                Math.round(data[1][i]) +
                '</h1><p>Keyword(s) Matched</p></div></div>'
              +
              '<p>' + data[0][i].industry + '</p>'
             + '<div class="divider"></div>' +
             '<h4 class="name_title">Job Description</h4><br/>'+
              + '<p>' + data[0][i].job_description+ '</p>' + '<div class="divider"></div>' + '<h4 class="name_title">Job Skills</h4><br/><p>'
             + data[0][i].skills+ '</p>' + '<div class="divider"></div><h4 class="name_title">Resume Skills Keyword(s) matched</h4><br/>' + '<p>'  + blkstr.join(", ") + '</p>' + '</div>'));
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

            count++;
         }
        });
        $('.right_col').show();
        $("#fakeLoader").remove();
        // $('.chart').data('easyPieChart').enableAnimation();

  },
  error: function(msg){
        console.log('fail request');
        $("#fakeLoader").remove(); //hide fakeLoader
  }
  });


</script>
<script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>

@endpush
