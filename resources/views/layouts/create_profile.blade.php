@extends('layouts.master')

@section('content')
@include('includes.message-block')
<!-- CREATE PROFILE -->
<div class="right_col" role="main">
  <div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <div class="count">Create Profile</div>
    </div>
  </div>

  <section class="row new-post">
      <div class="col-md-6 col-md-offset-3">
<!--           <header><h3>What do you have to say?</h3></header> -->
<!--             {{  Form::open(['route' => 'new.post','method'=>'post']) }} -->
<!--               <div class="form-group"> -->
<!--                 {!! Form::text('body', null, ['class' => 'form-control', 'id' => 'new-post', 'rows' => '5', 'placeholder' => 'Your Post']) !!} -->
<!--               </div> -->
<!--               {{ Form::submit('Create Post', ['class'=>'btn btn-primary']) }} -->
<!--           {!! Form::close() !!} -->

		<div class="form-group">
<!-- 			<img id="profilepic" class="center-block img-responsive" title="Click to upload photo" src=""> -->
		      <div class="centered">Click to upload photo</div>
		</div>

		<div class="form-group">
            {!! Form::label('name', 'Your Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('email', 'E-mail Address') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::text('password', null, ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password']) !!}
        </div>
		
		<div class="form-group">
            {!! Form::label('mobile', 'Contact No') !!}
            {!! Form::text('mobile', null, ['class' => 'form-control', 'id' => 'mobile', 'placeholder' => 'Mobile']) !!}
        </div>
        
        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

		{!! Form::close() !!}
        
         </div>
  </section>

  <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Edit Post</h4>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="form-group">
                          <label for="post-body">Edit the Post</label>
                          <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</div>

@push('scripts')
<!-- Switchery -->
<script src="{{ asset('js/switchery.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>
<!-- Autosize -->
<script src="{{ asset('js/autosize.min.js') }}"></script>
<!-- jQuery autocomplete -->
<script src="{{ asset('js/jquery.autocomplete.min.js') }}"></script>
<!-- starrr -->
<script src="{{ asset('js/starrr.js') }}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('js/prettify.js') }}"></script>

<!-- jquery tags input -->
<script src="{{ asset('js/jquery.tagsinput.js') }}"></script>

<!-- bootstrap-wysiwyg -->
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>

@endpush
<script>
  //for modal
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('edit.post') }}';
    var urlLike = '{{ route('like.post') }}';
    var postId = 0;

    $(document).ready(function () {
      $(".edit").click(function () {
          postId = $(this).data('id');
          $('#post-body').val($(this).data('content'));
          $('#edit-modal').modal('show');
        });

        //Pending for a more modern way to solve this
        $("#modal-save").click(function () {
          var saveData = $.ajax({
          type: 'POST',
          url: urlEdit,
          data:  {id: postId, content: $('#post-body').val(), _token:token},
          dataType: "text",
          success: function(resultData) {
              window.location.reload();
               }
            });
          });
      });
</script>
@endsection
