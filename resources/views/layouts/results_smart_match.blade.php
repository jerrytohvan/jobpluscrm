@extends('layouts.master')


@push('stylesheets')
@endpush


@section('content')
<!-- page content -->
<div class="right_col" role="main" style="min-height: 872px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Results - Smart Match</h3>
              </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Smart Match <small>Here's what we found out!</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


                    <div class="col-md-12 col-lg-12 col-sm-12">
                      <h2>3 Suitable Job Positions that you can consider! </h2>
                      @foreach($results as $result)
                      <h4>- {{ $result }}</h4>
                      @endforeach
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12">
                      <h2>We found these available jobs that suits you! </h2>
                      <h4> - </h4>

                    </div>
                    <div class="clearfix"></div>

                    <a href="{{ route('index.smart.match')}}" class="btn btn-success">Back to Smart Match</a>
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

</script>
@endpush
