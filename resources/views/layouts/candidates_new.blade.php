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
            <h2>Add a Candidate<small>Fill in the particulars below</small></h2>

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
              <label for="gender" class="control-label col-md-3 col-sm-3 col-xs-12">Gender <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="gender" class="btn-group" data-toggle="buttons" >
                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender"  value="M"  required="required">  Male
                  </label>
                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                    <input type="radio" name="gender"  value="F"  required="required">  Female
                  </label>
                </div>
              </div>
            </div>

              <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
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

              <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="birthdate">Birth Date *</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" class="form-control col-md-7 col-xs-12"  data-date-format="MM/DD/YYYY" required="required" id="birthdate" name="birthdate" value='' />
                </div>
              </div> -->

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="industry">Industry *</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" required="required" id="industry" name="industry" tabindex="-1">
                    <option value="">Select an Industry</option>
                    <option value="Accounting / Audit / Tax Services">Accounting / Audit / Tax Services</option>
                    <option value="Advertising / Marketing / Promotion / PR">Advertising / Marketing / Promotion / PR</option>
                    <option value="Aerospace / Aviation / Airline">Aerospace / Aviation / Airline</option>
                    <option value="Agricultural / Plantation / Poultry / Fisheries">Agricultural / Plantation / Poultry / Fisheries</option>
                    <option value="Apparel">Apparel</option>
                    <option value="Architectural Services / Interior Designing">Architectural Services / Interior Designing</option>
                    <option value="Arts / Design / Fashion">Arts / Design / Fashion</option>
                    <option value="Automobile / Automotive Ancillary / Vehicle">Automobile / Automotive Ancillary / Vehicle</option>
                    <option value="Banking / Financial Services">Banking / Financial Services</option>
                    <option value="BioTechnology / Pharmaceutical / Clinical research">BioTechnology / Pharmaceutical / Clinical research</option>
                    <option value="Call Center / IT-Enabled Services / BPO">Call Center / IT-Enabled Services / BPO</option>
                    <option value="Chemical / Fertilizers / Pesticides">Chemical / Fertilizers / Pesticides</option>
                    <option value="Computer / Information Technology (Hardware)">Computer / Information Technology (Hardware)</option>
                    <option value="Computer / Information Technology (Software)">Computer / Information Technology (Software)</option>
                    <option value="Construction / Building / Engineering">Construction / Building / Engineering</option>
                    <option value="Consulting (Business &amp; Management)">Consulting (Business &amp; Management)</option>
                    <option value="Consulting (IT, Science, Engineering &amp; Technical)">Consulting (IT, Science, Engineering &amp; Technical)</option>
                    <option value="Consumer Products / FMCG">Consumer Products / FMCG</option>
                    <option value="Education">Education</option>
                    <option value="Electrical &amp; Electronics">Electrical &amp; Electronics</option>
                    <option value="Entertainment / Media">Entertainment / Media</option>
                    <option value="Environment / Health / Safety">Environment / Health / Safety</option>
                    <option value="Exhibitions / Event management / MICE">Exhibitions / Event management / MICE</option>
                    <option value="Food &amp; Beverage / Catering / Restaurant">Food &amp; Beverage / Catering / Restaurant</option>
                    <option value="Gems / Jewellery">Gems / Jewellery</option>
                    <option value="General &amp; Wholesale Trading">General &amp; Wholesale Trading</option>
                    <option value="Government / Defence">Government / Defence</option>
                    <option value="Grooming / Beauty / Fitness">Grooming / Beauty / Fitness</option>
                    <option value="Healthcare / Medical">Healthcare / Medical</option>
                    <option value="Heavy Industrial / Machinery / Equipment">Heavy Industrial / Machinery / Equipment</option>
                    <option value="Hotel / Hospitality">Hotel / Hospitality</option>
                    <option value="Human Resources Management / Consulting">Human Resources Management / Consulting</option>
                    <option value="Insurance">Insurance</option>
                    <option value="Journalism">Journalism</option>
                    <option value="Law / Legal">Law / Legal</option>
                    <option value="Library / Museum">Library / Museum</option>
                    <option value="Manufacturing / Production">Manufacturing / Production</option>
                    <option value="Marine / Aquaculture">Marine / Aquaculture</option>
                    <option value="Mining">Mining</option>
                    <option value="Non-Profit Organisation / Social Services / NGO">Non-Profit Organisation / Social Services / NGO</option>
                    <option value="Oil / Gas / Petroleum">Oil / Gas / Petroleum</option>
                    <option value="Others">Others</option>
                    <option value="Polymer / Plastic / Rubber / Tyres">Polymer / Plastic / Rubber / Tyres</option>
                    <option value="Printing / Publishing">Printing / Publishing</option>
                    <option value="Property / Real Estate">Property / Real Estate</option>
                    <option value="R&amp;D">R&amp;D</option>
                    <option value="Repair &amp; Maintenance Services">Repair &amp; Maintenance Services</option>
                    <option value="Retail / Merchandise">Retail / Merchandise</option>
                    <option value="Science &amp; Technology">Science &amp; Technology</option>
                    <option value="Security / Law Enforcement">Security / Law Enforcement</option>
                    <option value="Semiconductor / Wafer Fabrication">Semiconductor / Wafer Fabrication</option>
                    <option value="Sports">Sports</option>
                    <option value="Stockbroking / Securities">Stockbroking / Securities</option>
                    <option value="Telecommunication">Telecommunication</option>
                    <option value="Textiles / Garmen">Textiles / Garment</option>
                    <option value="Tobacco">Tobacco</option>
                    <option value="Transportation / Logistics">Transportation / Logistics</option>
                    <option value="Travel / Tourism">Travel / Tourism</option>
                    <option value="Utilities / Power">Utilities / Power</option>
                    <option value="Wood / Fibre / Paper">Wood / Fibre / Paper</option>

                    </select>
                  </div>
              </div>

            <div class="form-group">
              <div class="control-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for"keywords">Summary Keywords<br/><small>Press enter for each keyword</small></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tags_1" type="text" class="tags" required="required" name="keywords" id="keywords" value="" style="display: none;">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="resume">Upload your resume (doc/docx/pdf format)<span class="required">*</span></label>
              <div class="col-md-6 col-sm-9 col-xs-12">
                  <input type="file"  required="required" name="resume" id="resume js-file-validation-example"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf"  />
              </div>
            </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button class="btn btn-primary" type="reset">Reset</button>
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
