@if(Auth::user()->admin == 1)
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
                  <h2>User List</h2>

                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="table-responsive">
                    <div class="dataTables_length" id="datatable_industry"></div>
                      <table id="datatable" class="table table-striped table-bordered dataTables"  >
                      <thead>
                        <tr>
                            <th style="width: 10%">Name</th>
                            <!-- <th style="width: 25%">Priviledge</th> -->
                            <th>Created At</th>
                            <th>Last Updated</th>
                            <th>Admin/User</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <!-- <td>1</td> -->
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>{{ $user->admin == 1 ? "Admin" : "User" }}</td>
                            <td>
                              <a onclick="edituser( {{ $user }} )" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Edit</a>
                              <a onclick="resetuser( {{ $user }} )" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Reset Password </a>
                              <a onclick="deleteuser( {{ $user }} )" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
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

<div class="modal fade" tabindex="-1" role="dialog" id="edit-user">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'update.admin','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'account_form']) }}

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="handphone">Handphone No</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="handphone" name="handphone" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telegram Id
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="teleid" name="teleid" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Birth Date
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="date" class="form-control col-md-7 col-xs-12" id="birthdate" name="birthdate"/>
                  </div>

                </div>
               <div class="ln_solid"></div>
               <input type="hidden" id="user_id" name="user_id" value="">

               {!! Form::close() !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary"  onclick="updateAdmin();" >Update</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
	  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="reset-user">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'reset.admin','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'reset_form']) }}

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">New Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Confirm Password <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="password" id="confirmpw" name="confirmpw" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

               <div class="ln_solid"></div>
               <input type="hidden" id="id" name="id" value="">

               {!! Form::close() !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary"  onclick="resetPassword();" >Reset Password</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
	  </div>

     <div class="modal fade" tabindex="-1" role="dialog" id="delete-user">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'delete.admin','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
               <p>Are you sure you want to delete this user? This action cannot be undone.</P>
               <input type="hidden" id="uid" name="uid" value="">

               {!! Form::close() !!}

               <button type="button" class="btn btn-danger"  onclick="deleteAdmin();" >Confirm Delete</button>
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
<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>

<script type="text/javascript">

function edituser(user) {
  $('#user_id').val(user.id);
  $('#name').val(user.name);
  $('#email').val(user.email);
  $('#teleid').val(user.tele_id);
  $('#handphone').val(user.handphone);
  $('#birthdate').val(user.birth_date);

  $('#edit-user').modal('show');
}

function resetuser(user) {
  $('#id').val(user.id);
  $('#reset-user').modal('show');
}

function deleteuser(user) {
  $('#uid').val(user.id);
  $('#delete-user').modal('show');
}

function updateAdmin(){
  $('#account_form').submit();
}

function resetPassword() {
  $('#reset_form').submit();
}

function deleteAdmin() {
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

$(document).ready(function() {
  $('#datatable').DataTable( {
    dom: 'lBfrtip',
      select: true,
      buttons: ['copy','csv','print'],
      "bDestroy": true
  } );
} );
</script>

@endpush

@else
@php abort(404) @endphp

@endif
