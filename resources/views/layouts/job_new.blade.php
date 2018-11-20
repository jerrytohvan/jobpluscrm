
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

<style>

.editor-wrapper {
  min-height: 100px;
}

</style>
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
            <h2>Add a Job<small>Fill in the particulars below</small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            {{  Form::open(['route' => 'add.job','method'=>'post', 'id'=>'submit-form', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job_title">Job Title<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="job_title" name="job_title" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

                <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job_description">Job Description:</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  
                  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
              
                    <div class="btn-group">
                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                      <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                      </div>
                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                    </div>
                  </div>
				  
                  <div id="editor-one" class="editor-wrapper"></div>
				  
                  <textarea name="job_description" id="job_description" placeholder="Type job description here" style="display:none;"></textarea>
                  <br />
				 </div>
			</div>
			<!-- End of Description -->

			<div class="form-group">
             <label class="control-label  col-md-3 col-sm-3 col-xs-12" for="job_description">Skills & Qualifications:</label>
			 <div class="col-md-6 col-sm-6 col-xs-12">
                  
                  <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-two">
              
                    <div class="btn-group">
                      <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                      <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                      <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                      <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                      <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                      <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                      <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                      <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                      <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                      <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                      <div class="dropdown-menu input-append">
                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                        <button class="btn" type="button">Add</button>
                      </div>
                      <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                    </div>

                    <div class="btn-group">
                      <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                      <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                    </div>
                  </div>
				  
                  <div id="editor-two" class="editor-wrapper"></div>
				  
                  <textarea name="job_skills" id="job_skills" placeholder="Type skills here" style="display:none;"></textarea>
                  <br />

				 </div>
			</div> <!-- End of Skills -->

      <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="years_of_experience">Minimum years of experience<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="years_of_experience" name="years_of_experience" required="required" data-parsley-type="integer" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="industry">Industry<span class="required">*</span></label>
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Client<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" required="required" id="company" name="company" tabindex="-1">
                      <option value ="">Select a company</option>
                      @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

            <div class="form-group">
              <div class="control-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for"keywords">Summary Keywords<span class="required">*</span>
                <br/><small>Press enter for each keyword</small></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tags_1" type="text" class="tags" required="required" name="keywords" id="keywords" value="" style="display: none;">
                </div>
              </div>
            </div>
			
			

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
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

    $(function() {
          $('#submit-form').on("submit",function(e) {
              $('#job_description').val($('#editor-one').html());
              $('#job_skills').val($('#editor-two').html());
          $('#submit-form').submit();
        });
      });
</script>

@endpush
