@extends('layouts.master')

@push('stylesheets')
<script src="https://unpkg.com/vue"></script>

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
@endpush

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->

  <div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Task(s) Overdue </span>
      <div class="count">{{$tasksOverdue}}</div>
      <span class="count_bottom">
        @if(is_string($overdueComparison))
        <i><i>

        @elseif ($overdueComparison < 0)
        <i class="green"><i class="fa fa-sort-desc">
          @elseif($overdueComparison > 0)
        <i class="red"><i class="fa fa-sort-asc">
        @endif  </i> {{ is_string($overdueComparison) || $overdueComparison > 0  ? $overdueComparison: $overdueComparison  * -1 }}%</i> From Last Week</span>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
     <span class="count_top"><i class="fa fa-clock-o"></i> Completed Task(s) YTD</span>
     <div class="count"> {{$totalTaskCompletedThisYear }}</div>
     <span class="count_bottom">
     </span>
   </div>


     <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Companies YTD</span>
      <div class="count"> {{$companiesYTD}}</div>
    </div>

  <!-- /top tiles-->

    <!-- start vue -->
    {{  Form::open(['route' => 'dashboard','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'modal_form_id', 'enctype'=>'multipart/form-data']) }}
    <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="from">From
      </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input type="date" class="form-control col-md-2 col-xs-12" id="from" name="from" value="{{ date('Y-m-d',strtotime($fromDate)) }}"/>
      </div>

      <label class="control-label col-md-1 col-sm-1 col-xs-12" for="to">To
      </label>
      <div class="col-md-2 col-sm-2 col-xs-12">
          <input type="date" class="form-control col-md-2 col-xs-12" id="to" name="to" value="{{ date('Y-m-d',strtotime($toDate)) }}"/>
      </div>

      <div class="col-md-2 col-sm-2 col-xs-12">
        <input type="hidden" name="dateInserted" value="1"/>
        <button type="button" class="btn btn-primary"  onclick="submitform();" >Search</button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="well" id="app">
           <task-draggable :tasks-open="{{ $tasksOpen }}" :tasks-on-going="{{ $tasksOnGoing }}" :tasks-closed="{{ $tasksClosed }}"></task-draggable>
         </div> <!-- end app -->
     </div>
    </div>
    <!-- end vue -->


      <!-- start of table  -->
      <!-- page content -->
    </div>

         <div class="clearfix"></div>


    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="edit-task">
          <div class="modal-dialog">
             <div class="modal-content">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Edit Task</h4>
                </div>
                <div class="modal-body">
                   {{  Form::open(['route' => 'edit.task','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'updateTask']) }}

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Task Title <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                   </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Due Date</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input  type="date"  id="date" name="date" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                      </div>
                   </div>


                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select User</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      @if(Auth::user()->admin == true)
                      <select class="select2_single form-control" id="consultant" name="consultant"   tabindex="-1">
                      @else
                      <select class="select2_single form-control" id="consultant" name="consultant" disabled tabindex="-1">

                      @endif
                        <option id="assigned_user"  selected="selected" value="">Select a User</option>
                        @foreach($consultants as $user)
                            <option value="{{ $user-> id }}">{{ $user->name }}</option>
                        @endforeach
                        <option value="">No user assigned</option>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Company
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" readonly id="company" name="company" class="form-control col-md-7 col-xs-12">
                      </div>
                   </div>
                   <div class="ln_solid"></div>
                   <input type="hidden" id="task_id" name="task_id" value="">
                   {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary"  onclick="updateTask();" >Update</button>
                </div>
             </div>
             <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    	  </div>



<!-- /page content -->

@endsection

@push('scripts')
<script src="{{ asset('js/parsley.min.js') }}"></script>
<script src="{{ asset('js/vue-app-compiled.js') }}"></script>
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>

<script>
var ar = {!! json_encode($consultants) !!};
console.log(ar[0].name);
$(document).ready(function() {
    $('.ui-pnotify').remove();
    var announcement = "{{ $announcementMsg }}";

    if( announcement != ""){
      new PNotify({
          title: "Welcome to JobPlusPlus",
          text: `<strong>Here's your latest announcement:</strong><br/>` + announcement,
          addclass: 'dark',
          styling: 'bootstrap3',

          desktop: {
           desktop: true
       }
   });
    }
} );


function loadNotification(){
  var message = "{{ $message }}";
  var status = "{{ $status }}";

  if(message != "" && status != ""){
    new PNotify({
        title: (status == 1 ? "Success!" : "Failed!"),
        text: message,
        type: (status == 1 ? "success" : "error"),
        styling: 'bootstrap3'
    });
  }

}
function submitform()
{
  $('#modal_form_id').submit();
}

function updateTask(){
  $('#updateTask').submit();
}


function editTask(e) {
  var task_id = e.getAttribute('data-id');
  var task_title = e.getAttribute('data-title');
  var task_desc = e.getAttribute('data-desc');
  var task_date = new Date(e.getAttribute('data-date'));
  task_date.setDate(task_date.getDate() + 1);

  var task_company = e.getAttribute('data-company');
  var task_assignee = e.getAttribute('data-assignee');
  var task_creator = e.getAttribute('data-creator');

  $('#updateTask').find('input[name=task_id]').val(task_id);
  $('#updateTask').find('input[name=title]').val(task_title);
  $('#updateTask').find('input[name=company]').val(task_company);
  $('#updateTask').find('input[name=description]').val(task_desc);


  document.getElementById("date").valueAsDate = task_date;

  if(task_assignee === ""){
    document.getElementById("consultant").value = '';
    document.getElementById("consultant").text = 'Select a User';
  }else{
    for (var i = 0; i < ar.length; i++) {
      if(ar[i].name == task_assignee){
          document.getElementById("assigned_user").value = ar[i].id;
          document.getElementById("assigned_user").text = task_assignee;
      }
    }
   }

  $('#edit-task').modal('show');
}

</script>
@endpush
