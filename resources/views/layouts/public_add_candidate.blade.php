@extends('layouts.master')


@push('stylesheets')
<!-- bwysiwyg -->
<link href="{{ asset('css/prettify.min.css') }}" rel="stylesheet">
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
<!-- Switchery -->
<link href="{{ asset('css/switchery.min.css') }}" rel="stylesheet">
<!-- starrr -->
<link href="{{ asset('css/starrr.css') }}" rel="stylesheet">

<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">

@endpush

@section('title')
  JobPlusCRM - Add Job
@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3></h3>
      </div>


    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Finding your future!</h2>

            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <br />
            {{  Form::open(['route' => 'add.new.candidate','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'job_search', 'enctype'=>'multipart/form-data']) }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
              <label for="gender" class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="gender" class="btn-group" data-toggle="buttons">
                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" checked value="M"> &nbsp; Male &nbsp;
                  </label>
                  <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender" value="F"> Female
                  </label>
                </div>
              </div>
            </div>

              <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="title" id="title" required="required" data-parsley-required-message="Please select a title" tabindex="-1">
                            <option value=''>Select a Job Level Title</option>
                            <option value='Entry/Junior'>Entry/Junior</option>
                            <option value='Intermediate'>Intermediate</option>
                            <option value='Senior'>Senior</option>
                            <option value='Lead'>Lead</option>
                          </select>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="handphone">Handphone No <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="handphone" name="handphone" required="required" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone No
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="telephone" name="telephone"  data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthdate">Birth Date</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" class="form-control col-md-7 col-xs-12"  data-date-format="MM/DD/YYYY" required="required" id="birthdate" name="birthdate" value='' />
                </div>
              </div>

              <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resume">Upload your resume (doc/docx/pdf format)<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                            <input type="file" name="resume" id="resume js-file-validation-example"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf"  />
                        </div>
                      </div>
                <div class="form-group">
                  <div class="control-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for"summary_keywords">Please describe your skills, interest, and jobs you desired in keywords!<br/><small>Press enter for each keyword</small></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="tags_1" type="text" class="tags" required="required" name="summary_keywords" id="summary_keywords" value="" style="display: none;">
                      </div>
                  </div>
                </div>



              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  {{ Form::submit('Submit', ['class'=>'btn btn-success']) }}

                </div>
              </div>

          {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- /page content -->
@endsection



@section('bottom_content')

@endsection

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


<script type="text/javascript">

    $(document).ready(function () {
      $('.ui-pnotify').remove();
        loadNotification();
    });
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



  var app = app || {};

  // Utils
  (function ($, app) {
      'use strict';

      app.utils = {};

      app.utils.formDataSuppoerted = (function () {
          return !!('FormData' in window);
      }());

  }(jQuery, app));

  // Parsley validators
  (function ($, app) {
      'use strict';

      window.Parsley
          .addValidator('filemaxmegabytes', {
              requirementType: 'string',
              validateString: function (value, requirement, parsleyInstance) {

                  if (!app.utils.formDataSuppoerted) {
                      return true;
                  }

                  var file = parsleyInstance.$element[0].files;
                  var maxBytes = requirement * 1048576;

                  if (file.length == 0) {
                      return true;
                  }

                  return file.length === 1 && file[0].size <= maxBytes;

              },
              messages: {
                  en: 'File is to big'
              }
          })
          .addValidator('filemimetypes', {
              requirementType: 'string',
              validateString: function (value, requirement, parsleyInstance) {

                  if (!app.utils.formDataSuppoerted) {
                      return true;
                  }

                  var file = parsleyInstance.$element[0].files;

                  if (file.length == 0) {
                      return true;
                  }

                  var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                  return allowedMimeTypes.indexOf(file[0].type) !== -1;

              },
              messages: {
                  en: 'File mime type not allowed'
              }
          });

  }(jQuery, app));


  // Parsley Init
  (function ($, app) {
      'use strict';

      $('#js-file-validation-example').parsley();

  }(jQuery, app));
</script>
@endpush
