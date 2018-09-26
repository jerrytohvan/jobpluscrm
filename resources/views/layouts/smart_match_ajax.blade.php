@extends('layouts.master')


@push('stylesheets')
<link href="{{ asset('css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fakeLoader.css') }}" rel="stylesheet">


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
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Smart Match <small>Here's what we found out!</small></h2>

                    <div class="clearfix"></div>

                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-lg-12 col-sm-12" id="table-list">
                      <h2>10 Matching Job Positions:</h2>

                    </div>


                    <div class="clearfix"></div>

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

<script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('js/fakeLoader.min.js') }}"></script>

<script>

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
            var sum = 0;
            for (var j = 0; j< data[1][i].length; j++) {
              sum += data[1][i][j]
            }
            var $tr = $('#table-list').append(
                 $('<h4>' + data[0][i].job_title + '</h4>'),
                 $('<ul>'),
                   $('<li>').text('Job Description: ' + data[0][i].job_description),
                   $('</li>'),
                   $('<li>').text('Skills: ' + data[0][i].skills),
                   $('</li>'),
                   $('<li>').text('Total Matching Keywords: ' + sum),
                   $('</li>'),
                   $('</ul>'),
                   $('<br/>')
               );
         }
        });
        $('.right_col').show();

        $("#fakeLoader").remove(); //hide fakeLoader

  		},
  		error: function(msg){
        console.log('fail request');
        $("#fakeLoader").remove(); //hide fakeLoader
  		}
  	});


</script>
@endpush
