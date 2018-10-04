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
                  <h2>Company Clients List</h2>

                  <div class="clearfix"></div>
               </div>
               <div class="x_content">

                        <div class="table-responsive">
                          <div class="dataTables_length" id="datatable_industry">
                          </div>
                           <table id="datatable" class="table table-striped table-bordered dataTables"  >
                             <thead>
                                  <tr>
                                      <th style="width: 10%">Name</th>
                                      <th style="width: 25%">Accounts</th>
                                      <th>Collaborators</th>
                                      <th>Industry</th>
                                      <th>Score</th>
                                      <th style="width: 15%">Action</th>
                                      <th>Latest Update</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($array as $data)
                                <tr role="row" class="{{ (($data->id % 2) == 1) ? 'odd':'even'}}">
                                  <td>{{ $data->name }}</td>
                                  <td>
                                    @php
                                      $accounts = $data->employees;
                                    @endphp
                                    <ul style="list-style: none; padding: 0;">
                                    @foreach($accounts as $account)
                                          <li> <b> {{ $account->name . ": " }} </b> {{ $account->telephone }} </li>
                                    @endforeach
                                    <ul>
                                  </td>
                                  <td>
                                    @php
                                      $collaborators = $data->collaborators;
                                    @endphp
                                    <ul class="list-inline">
                                      @if(!empty($collaborators))
                                        @foreach($collaborators as $profile)
                                      <li>
                                          <!-- <b> {{ $profile->name }} </b> -->
                                          <img src="{{ $profile->profile_pic }}" class="avatar" alt="{{ $profile->name }}" title="{{ $profile->name }}">
                                      </li>
                                        @endforeach
                                      @endif
                                  </td>
                                  <td>
                                    {{ $data -> industry }}
                                  </td>
                                  @foreach ($score as $companyId=>$thisScore)
                                    @if ($companyId == $data->id)
                                      <td>
                                        {{ $thisScore }}
                                      </td>
                                    @endif
                                  @endforeach
                                  <td>
                                      <a href="{{ route('view.company', ['company' => $data->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                      <a href="{{ route('delete.company', ['company_id' => $data->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                  <td>
                                    @php
                                      $latest_update = $data->updated_at;

                                      $employeesUpdate = $data->employees->max('updated_at');
                                      if ($employeesUpdate > $latest_update) {
                                        $latest_update = $employeesUpdate;
                                      }

                                      $postUpdate = $data->posts->max('updated_at');
                                      if ($postUpdate > $latest_update) {
                                        $latest_update = $postUpdate;
                                      }

                                      $collaboratorsUpdate = $data->collaborators->max('updated_at');
                                      if ($collaboratorsUpdate > $latest_update) {
                                        $latest_update = $collaboratorsUpdate;
                                      }

                                      $tasksUpdate = $data->tasks->max('updated_at');
                                      if ($tasksUpdate > $latest_update) {
                                        $latest_update = $tasksUpdate;
                                      }

                                    @endphp
                                      {{ $latest_update }}
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

function submitform()
{
  $('#modal_form_id').submit();
}

$(document).ready(function() {

    $('#datatable').DataTable( {
      dom: 'lBfrtip',
        select: true,
        buttons: [
          'copy','csv','print',{
                text: 'Sort by Urgency',
                action: function () {
                  this.column(4).order('desc').draw();
                }
            }
        ],
        initComplete: function () {
          this.api().columns([3]).every( function () {
                var column = this;
                var select = $('<br>Industry:<select><option value=""></option></select>')
                    .appendTo('#datatable_wrapper .dataTables_filter')
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

var elems = document.getElementsByClassName('confirmation');
var confirmIt = function (e) {
    if (!confirm('Are you sure?')) e.preventDefault();
};
for (var i = 0, l = elems.length; i < l; i++) {
    elems[i].addEventListener('click', confirmIt, false);
}

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
