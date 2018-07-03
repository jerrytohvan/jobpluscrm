<!-- VALIDATION WITH LARAVEL'S HELPER-->
<div class="row">
@if(count($errors)>0)
  <div class="col-md-4 col-md-offset-4 error">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif
@if(Session::has('message'))
    <div class="col-md-4 col-md-offset-4 success">
        {{ Session::get('message') }}
    </div>
@endif