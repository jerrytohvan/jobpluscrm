@extends('layouts.master')

@section('content')

@push('stylesheets')

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
<!-- bwysiwyg -->
<link href="{{ asset('css/prettify.min.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<!-- Switchery -->
<link href="{{ asset('css/switchery.min.css') }}" rel="stylesheet">
<!-- starrr -->
<link href="{{ asset('css/starrr.css') }}" rel="stylesheet">

@endpush

<!-- SOCIAL WALL -->
<div class="right_col" role="main">


  <section class="row new-post">
    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
          <header>
          <div class="row tile_count">
              <div class="tile_stats_count">
                <div class="count">Announcements</div>
              </div>
            </div>
          </header>
            {{  Form::open(['route' => 'new.post','method'=>'post']) }}
              <div class="form-group">

                {!! Form::text('body', null,  ['class' => 'form-control', 'id' => 'new-post', 'rows'=> '5' ,'cols'=> '14','placeholder' => 'Your Announcement']) !!}
              </div>

                <div class="pull-right">
                {{ Form::submit('Send!', ['class'=>'btn btn-primary', 'style' =>'background: #32213A; color: white;']) }}
            </div>
          {!! Form::close() !!}
      </div>
  </section>

  <section class="row posts">


        <div class="col-md-6 col-sm-12 col-xs-12  col-md-offset-3">
                    <div class="x_content">
                      <ul class="list-unstyled timeline">
                        @foreach($posts as $post)

                        <li class="post" data-postid="{{ $post->id }}">
                          <div class="block">
                            <div class="tags">
                            @php
                            $url = parse_url($post->user->profile_pic);
                            @endphp
                            @if(!empty($url['scheme']))
                               <img src="{{ $post->user->profile_pic }}" alt="Avatar" class="img-circle profile_img">
                            @else
                               <img src="{{ 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . ($post->user->profile_pic) }}" alt="Avatar" class="img-circle profile_img">
                            @endif
                               
                            </div>
                            <div class="block_content">
                              <h2 class="title">
                                              <a>{{ $post->user->name }}</a>
                                          </h2>
                              <div class="byline">
                                <span>{{  date("F j, Y \a\\t g:i a",strtotime($post->created_at))}}</span>
                              </div>
                              <p class="excerpt">
                                {{ $post->content }}
                              </p>
                              <div class="interaction">
                                    @php
                                        $like_count = DB::table('likes')->where('post_id', $post->id)->count();
                                    @endphp
                                    <span style="font-size: 1.5em;">
                                    @if ($like_count > 1)
                                        {{$like_count}}
                                    @elseif ($like_count > 0)
                                        {{$like_count}}
                                    @endif
                                  </span> <a href="{{ route('like.post', ['post_id' => $post->id, 'isLike' => 'true']) }}">

                                          @if(Auth::user()->likes()->where('post_id', $post->id)->first() != null &&
                                              Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1)
                                          <span class="fa fa-heart-o like" style="font-size: 1.5em;color:red; padding-right:1em;"></span></a>

                                          @else
                                          <span class="fa fa-heart-o like" style="font-size: 1.5em; padding-right:1em;"></span></a>

                                          @endif


                                  @if(Auth::user() == $post->user)
                                  <span class="pull-right">
                                    <a data-id="{{ $post->id }}" data-content="{{ $post->content }}" class="edit" id="Edit-modal"
                                             href="#edit-modal"><span class="fa fa-edit" style="font-size: 1.5em;padding-right:1em;"></span></a>

                                  <a onclick="deletePost( {{ $post->id }})" ><span class="fa fa-trash" style="font-size: 1.5em;"></span></a>
</span>
                                  @endif
                              </div>
                            </div>
                          </div>
                        </li>

@endforeach
                    </div>
                  </div>
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


  <div class="modal fade" tabindex="-1" role="dialog" id="confirm-delete">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Delete Post</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'delete.post','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
               <p>Are you sure you want to delete this post? This action cannot be undone.</P>
               <input type="hidden" id="post_id" name="post_id" value="">

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
    $(document).ready(function () {
        $('.ui-pnotify').remove();
        loadNotification();
    });

    function deletePost(postid) {
        $('#post_id').val(postid);
        $('#confirm-delete').modal('show');
    }

    function submitForm() {
        $('#delete_form').submit();
    }

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
      //for modal
      var token = `{{ Session::token() }}`;
      var urlEdit = `{{ route('edit.post') }}`;
      var urlLike = `{{ route('like.post') }}`;
      var postId = 0;

      $(document).ready(function() {
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
