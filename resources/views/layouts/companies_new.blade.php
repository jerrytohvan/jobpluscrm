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
            <h2>Add a Company<small>Fill in the particulars below</small></h2>
          </div>
          <div class="x_content">
            <br />
            {{  Form::open(['route' => 'add.new.company','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_name">Company Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="company_name" name="company_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Company Address <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="address" name="address" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company_email">Company Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="email" id="company_email" name="company_email" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Telephone No <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="telephone" name="telephone" required="required" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax">Fax No
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="fax" name="fax"  data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" id="website"  name="website"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_employees">No of Employees
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="no_employees"  name="no_employees"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="industry">Industry</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" id="industry" name="industry" tabindex="-1">
                      <option></option>
                      <option value="Aerospace industry">Aerospace industry</option>
                      <option value="Agriculture">Agriculture</option>
                      <option value="Fishing industry">Fishing industry</option>
                      <option value="Timber industry">Timber industry</option>
                      <option value="Tobacco industry">Tobacco industry</option>
                      <option value="Chemical industry">Chemical industry</option>
                      <option value="Pharmaceutical industry">Pharmaceutical industry</option>
                      <option value="Computer industry">Computer industry</option>
                      <option value="Software industry">Software industry</option>
                      <option value="Technology industry">Technology industry</option>
                      <option value="Construction industry">Construction industry</option>
                      <option value="Real estate industry">Real estate industry</option>
                      <option value="Public utilities industry">Public utilities industry</option>
                      <option value="Defense industry">Defense industry</option>
                      <option value="Arms industry">Arms industry</option>
                      <option value="Education industry">Education industry</option>
                      <option value="Energy industry">Energy industry</option>
                      <option value="Electrical power industry">Electrical power industry</option>
                      <option value="Petroleum industry">Petroleum industry</option>
                      <option value="Entertainment industry">Entertainment industry</option>
                      <option value="Financial services industry">Financial services industry</option>
                      <option value="Insurance industry">Insurance industry</option>
                      <option value="Food industry">Food industry</option>
                      <option value="Fruit production">Fruit production</option>
                      <option value="Health care industry">Health care industry</option>
                      <option value="Hospitality industry">Hospitality industry</option>
                      <option value="Information industry">Information industry</option>
                      <option value="Manufacturing">Manufacturing</option>
                      <option value="Electronics industry">Electronics industry</option>
                      <option value="Pulp and paper industry">Pulp and paper industry</option>
                      <option value="Steel industry">Steel industry</option>
                      <option value="Shipbuilding industry">Shipbuilding industry</option>
                      <option value="Mass Media Broadcasting">Mass Media Broadcasting</option>
                      <option value="Film industry">Film industry</option>
                      <option value="Music industry">Music industry</option>
                      <option value="News media">News media</option>
                      <option value="Publishing">Publishing</option>
                      <option value="World Wide Web">World Wide Web</option>
                      <option value="Mining">Mining</option>
                      <option value="Telecommunications industry">Telecommunications industry</option>
                      <option value="Transport industry">Transport industry</option>
                      <option value="Water industry">Water industry</option>
                      <option value="Other">Other</option>

                    </select>
                  </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lead_source">Lead Source</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" id="lead_source" name="lead_source" tabindex="-1">
                      <option></option>
                      <!-- http://www.themarketingscore.com/blog/bid/317180/18-Possible-Lead-Sources-Your-Organization-Needs-to-Measure -->
                      <option value="Blogging">Blogging</option>
                      <option value="Premium Content">Premium Content</option>
                      <option value="Organic Search">Organic Search</option>
                      <option value="Email Marketing">Email Marketing</option>
                      <option value="Digital Advertising">Digital Advertising</option>
                      <option value="Media Coverage">Media Coverage</option>
                      <option value="Social Media">Social Media</option>
                      <option value="Website">Website</option>
                      <option value="Direct Marketing">Direct Marketing</option>
                      <option value="Traditional Advertising">Traditional Advertising</option>
                      <option value="Sponsorships">Sponsorships</option>
                      <option value="Affiliate / Partner Programs">Affiliate / Partner Programs</option>
                      <option value="Events / Shows">Events / Shows</option>
                      <option value="Inbound Phone Calls">Inbound Phone Calls</option>
                      <option value="Outbound Sales">Outbound Sales</option>
                      <option value="Referrals">Referrals</option>
                      <option value="Speaking Engagements">Speaking Engagements</option>
                      <option value="Traditional / Offline Networking:">Traditional / Offline Networking:</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
              </div>
              <!-- <div class="form-group">
              <div class="control-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for"tags">Input Tags</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tags_1" type="text" class="tags" name="tags" id="tags" value="" style="display: none;">
                              </div>
                        </div>
                      </div> -->

          <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea class="resizable_textarea form-control" name="description" id="description" placeholder="Type here" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background:transparent!important; margin: 0px 8px 0px 0px; "></textarea>
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


</script>
@endpush
