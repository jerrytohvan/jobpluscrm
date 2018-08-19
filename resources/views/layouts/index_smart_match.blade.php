@extends('layouts.master')


@push('stylesheets')
@endpush


@section('content')
<!-- page content -->
<div class="right_col" role="main" style="min-height: 1144px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Smart Match</h3>
              </div>


            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Smart Match
                      <small>Employee Job Search</small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- Smart Wizard -->
                    <p>Fill in your particulars and we'll look for a suitable job that matches you!</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps anchor">
                        <li>
                          <a href="#step-1" class="selected" isdone="1" rel="1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br>
                                              <small>Personal Particulars</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2" class="disabled" isdone="0" rel="2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br>
                                              <small>Indicate your field of interest<br> and the kind a job you are looking for!</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3" class="disabled" isdone="0" rel="3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br>
                                              <small>Tell us more <br>
                                                about your work experiences & skill sets!</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4" class="disabled" isdone="0" rel="4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br>
                                              <small>One more step to go!<br> Upload your resume in doc/docx/pdf format!</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      {{  Form::open(['route' => 'search.job','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'job_search', 'enctype'=>'multipart/form-data']) }}

                    <div class="stepContainer" style="height: 281px;">

                      <div id="step-1" class="content" style="display: block;">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullname">Full Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text" id="fullname" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="gender" value="male"> &nbsp; Male &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                  <input type="radio" name="gender" value="female"> Female
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" placeholder="MM/DD/YYYY" data-date-format="MM/DD/YYYY" type="text">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                          </div>
                      </div>
                      <div id="step-2" class="content" style="display: none;">

                        <div class="form-group">
                        <div class="control-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for"interest">List down your field of interest in words! (Press 'Enter' to add more)</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="tags_1" type="text" class="tags" name="interest" id="interest" value="" style="display: none;">
                                        </div>
                                  </div>
                                </div>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job_description">Describe in less than 150 words the kind of job you are looking for!</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea rows="6" class="resizable_textarea form-control" name="job_description" id="job_description" placeholder="Type here" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background:transparent!important; margin: 0px 8px 0px 0px; "></textarea>
                          </div>
                      </div>
                      </div>
                      <div id="step-3" class="content" style="display: none;">
                        <h2 class="StepTitle">Tell us more about your skills and work experience!</h2>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="skills">Describe in less than 150 words</label>
                          <div class="col-md-8 col-sm-8r col-xs-12">
                            <textarea rows="6" class="resizable_textarea form-control" name="skills" id="skills" placeholder="Type here" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background:transparent!important; margin: 0px 8px 0px 0px; "></textarea>
                          </div>
                      </div>
                      </div>
                      <div id="step-4" class="content" style="display: none;">
                        <h2 class="StepTitle">Upload your resume (doc/docx/pdf format)</h2>
                        <input type="file" name="resume" id="js-file-validation-example"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf"  />
                      </div>
                    </div>
                    {!! Form::close() !!}

                  </div>

                    <!-- End SmartWizard Content -->

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

<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>

<script src="{{ asset('js/jquery.smartWizard.js') }}"></script>

<!-- jquery tags input -->
<script src="{{ asset('js/jquery.tagsinput.js') }}"></script>


<!-- custom file validation script -->
<script>
function submitform()
{
  $('#job_search').submit();
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
