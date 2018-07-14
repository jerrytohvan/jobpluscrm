@extends('layouts.master')

@section('content')
@include('includes.message-block')
<!-- SOCIAL WALL -->
<div class="right_col" role="main">
  <div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <div class="count">Social Wall</div>
    </div>
  </div>

  <section class="row new-post">
      <div class="col-md-6 col-md-offset-3">
          <header><h3>What do you have to say?</h3></header>
            {{  Form::open(['route' => 'new.post','method'=>'post']) }}
              <div class="form-group">
                {!! Form::text('body', null, ['class' => 'form-control', 'id' => 'new-post', 'rows' => '5', 'placeholder' => 'Your Post']) !!}
              </div>
              {{ Form::submit('Create Post', ['class'=>'btn btn-primary']) }}
          {!! Form::close() !!}
         </div>
  </section>
  <section class="row posts">
      <div class="col-md-6 col-md-offset-3">
          <header><h3>What other people say...</h3></header>
          @foreach($posts as $post)
              <article class="post" data-postid="{{ $post->id }}">
                  <p>{{ $post->content }}</p>
                  <div class="info">
                      Posted by {{ $post->user->name }} on {{ $post->created_at }}
                  </div>
                  <div class="interaction">
                      <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                      <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                      @if(Auth::user() == $post->user)
                          |
                          <a href="#" class="edit">Edit</a> |
                          <a href="{{ route('delete.post', ['post_id' => $post->id]) }}">Delete</a>
                      @endif
                  </div>
              </article>
          @endforeach
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

<script>
  //for modal
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('edit.post') }}';
    var urlLike = '{{ route('like.post') }}';
</script>
@endsection
