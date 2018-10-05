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
                  <h2>Candidates Full-List</h2>
              <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="table-responsive">
                     <table id="datatable" class="table table-striped table-bordered dataTables"  >
                       <thead>
                         <tr>
                           <th>Name</th>
                           <th>Title</th>
                           <th>Email</th>
                           <th>Handphone No.</th>
                           <th>Telephone No.</th>
                           <th>Birthdate</th>
                           <th style="width: 25%;">Action</th>
                         </tr>
                        </thead>
                        <tbody>
                          @foreach ($candidates as $candidate)
                          <tr role="row" class="{{ (($candidate->id % 2) == 1) ? 'odd':'even'}}">
                            <td>{{ $candidate->name }}</td>
                            <td>{{ $candidate->title }}</td>
                            <td>{{ $candidate->email }}</td>
                            <td>{{ $candidate->handphone }}</td>
                            <td>{{ $candidate->telephone == null ? "-" : $candidate->telephone }}</td>
                            <td>{{
                              date("F d, Y", strtotime($candidate->birthdate))}}</td>
                            <td>
                                 <a href="{{ route('get.resume', ['file'=> $candidate->files->first()->attachable_id])}}"  class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Resume</a>
                                 <a onclick="deleteCandidate( {{ $candidate->id }} )" class="btn btn-danger btn-xs confirmation"><i class="fa fa-trash-o"></i> Delete </a>
                                 <a href="{{ route('smart.match.candidate', ['candidate' => $candidate->id]) }}" class="btn btn-success btn-xs"><i class="fa fa-trash-o"></i>Smart Match</a>

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
   
   <div class="modal fade" tabindex="-1" role="dialog" id="confirm-delete">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Delete Candidate</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'delete.candidate','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
               <p>Are you sure you want to delete this candidate? This action cannot be undone.</P>
               <input type="hidden" id="candidate_id" name="candidate_id" value="">

               {!! Form::close() !!}
              
               <button type="button" class="btn btn-danger"  onclick="submitForm();" >Confirm Delete</button>
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
