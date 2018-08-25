@extends('layouts.master')


@push('stylesheets')
<!-- Datatables -->
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush


@section('content')
<div class="right_col" role="main" >
   <div class="">

      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Company Leads</h2>
                  <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li>

                     <li><a class="close-link"><i class="fa fa-close"></i></a>
                     </li>
                  </ul>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                        <div class="table-responsive">
                           <table id="datatable" class="table table-striped table-bordered dataTables"  >
                             <thead>
                                  <tr>
                                      <th style="width: 10%">Name</th>
                                      <th style="width: 20%">Address</th>
                                      <th style="width: 5%">Tel. No</th>
                                      <th>Industry</th>
                                      <th>Website</th>
                                      <th style="width: 15%">Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                                <!--  add convert to client-->
                                @foreach($array as $data)
                                <tr role="row" class="{{ (($data->id % 2) == 1) ? 'odd':'even'}}">
                                  <td>{{ $data->name }}</td>
                                  <td>{{ $data->address }}</td>
                                  <td>{{ $data->telephone_no }}</td>
                                  <td>{{ $data->industry == '' ? '-': $data->industry}}</td>
                                  <td>{{ $data->website == '' ? '-': $data->website }}</td>
                                  <td>
                                      <a href="{{ route('view.company', ['company' => $data->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                      <a href="{{ route('delete.company', ['company_id' => $data->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                           </table>
                         </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

@endsection



@section('bottom_content')

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
} );
</script>
<!-- Datatables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('js/dataTables.scroller.min.js') }}"></script>
<!-- jszip -->
<script src="{{ asset('js/jszip.min.js') }}"></script>
<!-- pdfmake -->
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>


@endpush
