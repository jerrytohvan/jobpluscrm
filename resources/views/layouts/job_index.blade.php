@extends('layouts.master')


@push('stylesheets')
<!-- Datatables -->
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
@endpush


@section('content')
<div class="right_col" role="main" >
   <div class="">

      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Job Lists</h2>
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
                                      <th style="width: 10%">Title</th>
                                      <th style="width: 25%">Description</th>
                                      <th>Skills</th>
                                      <th style="width: 15%">Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($jobs as $job)
                                <tr role="row" class="{{ (($job->id % 2) == 1) ? 'odd':'even'}}">
                                  <td>{{ $job->job_title }}</td>
                                  <td>{{ $job->job_description}}</td>
                                  <td>{{ $job->skills }}</td>
                                  <td>
                                    <a onclick="deletejob( {{ $job }} )" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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


   <div class="modal fade" tabindex="-1" role="dialog" id="delete-job">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Delete Job Post</h4>
          </div>
          <div class="modal-body">
             {{  Form::open(['route' => 'delete.job','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
             <p>Are you sure you want to delete this Job post? This action cannot be undone.</P>
             <input type="hidden" id="job" name="job" value="">

             {!! Form::close() !!}

             <button type="button" class="btn btn-danger"  onclick="deleteJob();" >Confirm Delete</button>
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

          </div>

       </div>
       <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


</div>

@endsection



@section('bottom_content')

@endsection

@push('scripts')

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


<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
} );


function deletejob(job) {
  $('#job').val(job.id);
  $('#delete-job').modal('show');
}

function deleteJob() {
  $('#delete_form').submit();
}

$(document).ready(function () {
  $('.ui-pnotify').remove();
    loadNotification();
});

function loadNotification(){
  var message = "{{ Session::get('message') }}";
  var status = "{{ Session::get('status') }}";

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
