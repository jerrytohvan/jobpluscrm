@extends('layouts.master')


@push('stylesheets')
<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
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
                  <h2>Dummy Task</h2>
              <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="table-responsive">
                     <table id="datatable" class="table table-striped table-bordered dataTables"  >
                       <thead>
                         <tr>
                           <th>Task</th>
                           <th>Due Date</th>
                           <th>Creator</th>
                           <th>Collaborator</th>
                           <th style="width: 25%;">Action</th>
                         </tr>
                        </thead>
                        <tbody>
                          @foreach ($tasksOpen as $task)
                          <tr role="row" class="{{ $task->id}}">
                            <td>{{$task->title}}</td>
                            <td>{{substr($task->date_reminder,0,10)}}</td>
                            <td>{{$task->creator}}</td>
                            <td>{{$task->company}}</td>     
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
    $('.ui-pnotify').remove();
      loadNotification();
} );

function loadNotification(){
  var message = "@php if(session()->has('message')){ echo session()->get('message'); }else { echo $message; } @endphp";
  var status = "@php if(session()->has('status')){ echo  session()->get('status'); }else { echo $status; } @endphp";

  if(message != "" && status != ""){
    new PNotify({
        title: (status == 1 ? "Success!" : "Failed!"),
        text: message,
        type: (status == 1 ? "success" : "error"),
        styling: 'bootstrap3'
    });
  }
}

function deleteCandidate(candidateId) {
  $('#candidate_id').val(candidateId);
  $('#confirm-delete').modal('show');
}

function submitForm() {
    $('#delete_form').submit();
}
// var elems = document.getElementsByClassName('confirmation');
// var confirmIt = function (e) {
//     if (!confirm('Are you sure?')) e.preventDefault();
// };
// for (var i = 0, l = elems.length; i < l; i++) {
//     elems[i].addEventListener('click', confirmIt, false);
// }


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
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>


@endpush
