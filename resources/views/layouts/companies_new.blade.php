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
            <div class="clearfix"></div>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uen">Company UEN</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="uen" name="uen" class="form-control col-md-7 col-xs-12">
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="url" id="website"  name="website"  class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_employees">No of Employees </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="select2_single form-control" id="no_employees" name="no_employees" tabindex="-1">
                        <option value></option>
                        <option value="1-5">1-5</option>
                        <option value="6-20">6-20</option>
                        <option value="21-100">21-100</option>
                        <option value="101-500">101-500</option>
                        <option value=">501">>501</option>
                      </select>
                  </div>
              </div>

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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lead_source">Lead Source</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" id="lead_source" name="lead_source" tabindex="-1">
                      <option></option>
                      <!-- http://www.themarketingscore.com/blog/bid/317180/18-Possible-Lead-Sources-Your-Organization-Needs-to-Measure -->
                      <option value="Affiliate / Partner Programs">Affiliate / Partner Programs</option>
                      <option value="Blogging">Blogging</option>
                      <option value="Digital Advertising">Digital Advertising</option>
                      <option value="Direct Marketing">Direct Marketing</option>
                      <option value="Email Marketing">Email Marketing</option>
                      <option value="Events / Shows">Events / Shows</option>
                      <option value="Inbound Phone Calls">Inbound Phone Calls</option>
                      <option value="Media Coverage">Media Coverage</option>
                      <option value="Organic Search">Organic Search</option>
                      <option value="Other">Other</option>
                      <option value="Outbound Sales">Outbound Sales</option>
                      <option value="Premium Content">Premium Content</option>
                      <option value="Referrals">Referrals</option>
                      <option value="Social Media">Social Media</option>
                      <option value="Speaking Engagements">Speaking Engagements</option>
                      <option value="Sponsorships">Sponsorships</option>
                      <option value="Traditional / Offline Networking:">Traditional / Offline Networking:</option>
                      <option value="Traditional Advertising">Traditional Advertising</option>
                      <option value="Website">Website</option>
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
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Type <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div id="client" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="client" required="required" value="1"> Client
                    </label>
                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="client"  value="0"> Lead
                    </label>
                  </div>
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
