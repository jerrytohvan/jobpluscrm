@extends('layouts.master')


@push('stylesheets')
<!-- Datatables -->
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">

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
<div class="right_col" role="main" >
   <div class="">

      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Job Lists</h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                        <div class="table-responsive">
                           <table id="datatable" class="table table-striped table-bordered dataTables"  >
                             <thead>
                                  <tr>
                                      <th style="width: 15%">Client Company</th>
                                      <th style="width: 10%">Job Title</th>
                                      <!-- <th style="width: 25%">Description</th>
                                      <th>Skills & Qualifications</th> -->
                                      <th style="width: 15%">Action</th>

                                  </tr>
                              </thead>
                              <tbody>
                              @foreach($jobs as $job)
                                <tr role="row" class="{{ (($job->id % 2) == 1) ? 'odd':'even'}}">
                                  @foreach($companies as $company)
                                    @if ($company->id == $job->company_id)
                                    <td>{{ $company->name }}</td>
                                    @endif
                                  @endforeach
                                  <td>{{ $job->job_title }}</td>
                                  <td>
                                  @foreach($companies as $company)
                                    @if ($company->id == $job->company_id)
                                    <a onclick="viewjob( {{ $job }}, {{ $company }} )" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
                                    @endif
                                  @endforeach

                                    <a onclick="editjob( {{ $job }} )" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a onclick="deletejob( {{ $job }} )" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                           </table>
                         </div>
               </div>
            </div>
         </div>

      </div>
   </div>

   <div class="modal fade" tabindex="-1" role="dialog" id="view-job">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="company_name1"></h4>
            </div>
            <div class="modal-body">

                <strong><p id="job_title1"></p></strong>
                <strong>Description: </strong><p id="job_description1"></p>
                <strong>Skills: </strong><p id="skills1"></p>
                <strong>Summary Keywords: </strong><p id="tags1"></p>
                <strong>Industry: </strong><p id="industry"></p>
				        <input type="hidden" id="company_id1" name="company_id1" value="">
                <!-- <input type="hidden" id="job_id1" name="job_id1" value=""> -->

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
	  </div>
	  <!-- End of view-job modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="edit-job">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Edit Job</h4>
            </div>
            <div class="modal-body">
            {{  Form::open(['route' => 'update.job','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'job_form']) }}

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="job_title">Job Title <span class="required">*</span>
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

                  <textarea name="skills" id="skills" placeholder="Type skills here" style="display:none;"></textarea>
                  <br />

				 </div>
			</div> <!-- End of Skills -->

               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="industry">Industry *</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="select2_single form-control" required="required" id="industry" name="industry" tabindex="-1">
                        @foreach($jobs as $job)
                          @if ($company->id == $job->company_id)
                            <option value="{{ $job->industry }}">{{  $job->industry }}</option>
                          @endif
                        @endforeach
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

               <!-- Not required field -->
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="years_experience">Year of Experience
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="years_experience" name="years_experience" class="form-control col-md-7 col-xs-12">
                  </div>
               </div>

              <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Company *</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control"  required="required" id="company_id" name="company_id" tabindex="-1"
                      @foreach($companies as $company)
                          <option value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group">
              <div class="control-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for"keywords">Summary Keywords<br/><small>Press enter for each keyword</small></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tags_1" type="text" class="tags" required="required" name="summary_keywords" id="keywords" style="display: none;">
                </div>
              </div>
            </div>

               <div class="ln_solid"></div>
               <input type="hidden" id="job_id" name="job_id">

               {!! Form::close() !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary"  onclick="updateJob();" >Update</button>
            </div>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
	  </div>

   <div class="modal fade" tabindex="-1" role="dialog" id="delete-job">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Delete Job Post</h4>
          </div>
          <div class="modal-body">
             {{  Form::open(['route' => 'delete.job','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
             <p>Are you sure you want to delete this Job post? This action cannot be undone.</P>
             <input type="hidden" id="job" name="job" value="">

             {!! Form::close() !!}

             <button type="button" class="btn btn-danger"  onclick="deleteJob();" >Confirm Delete</button>
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

<!-- Datatables -->
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('js/dataTables.scroller.min.js') }}"></script>
<!-- jszip -->
<script src="{{ asset('js/jszip.min.js') }}"></script>
<!-- pdfmake -->
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
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
<script>
$(document).ready(function() {
    $('#datatable').DataTable();
} );

//added
function editjob(job) {
  $('#job_id').val(job.id);
  $('#job_title').val(job.job_title);
  $('#category').val(job.category);
  $('#industry').val(job.industry);
  $('#years_experience').val(job.years_experience);
  $('.tags').importTags(job.summary_keywords);
  $('#company_id').val(job.company_id);

  $('#editor-one').html(job.job_description);
  $('#job_description').val($('#editor-one').html());
  $('#editor-two').html(job.skills);
  $('#skills').val($('#editor-two').html());

  $('#edit-job').modal('show');
}

function viewjob(job, company) {
  $('#company_name1').html(company.name);
  $('#company_id1').html(job.company_id);
  $('#job_title1').html(job.job_title);
  $('#job_description1').html(job.job_description);
  $('#skills1').html(job.skills);
  $('#industry').html(job.industry);
  $('#tags1').html(job.summary_keywords);

   $('#view-job').modal('show');
}

function updateJob(){
  $('#job_description').val($('#editor-one').html());
  $('#skills').val($('#editor-two').html());
  $('#job_form').submit();
}

function deletejob(job) {
  $('#job').val(job.id);
  $('#delete-job').modal('show');
}

function deleteJob() {
  $('#delete_form').submit();
}

$(document).ready(function () {
  $('.ui-pnotify').remove();
    loadNotification();
});

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

</script>

@endpush
