@extends('layouts.master')


@push('stylesheets')
<link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/vue"></script>


<!-- pnotify -->
<link href="{{ asset('css/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('css/pnotify.nonblock.css') }}" rel="stylesheet">
<link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/scroller.bootstrap.min.css') }}" rel="stylesheet">
<style>


#file_upload{
    display:none;
}

#hover_button:hover a ~ #delete_button{
    display: inline-block;
}
#delete_button {
  display: none;

}

/* scrollable */
.content
{
  height: 40vh;
    overflow:auto;
}
.gi-1x{
  top: 5px;
  font-size: 1.25em;
}

/* quick reset and base styles */
* {
  margin: 0;
  padding: 0;
  border: 0;
}

html {
  font-family: helvetica, arial, sans-serif;
}

/* relevant styles */
.img__wrap {
  position: relative;
  height: auto;
  width: auto;
}

.img__description_layer {
  position: absolute;
  top: 2em;
  bottom: 0;
  left: 7.5em;
  right: 0;
  background: rgba(36, 62, 206, 0.6);
  color: black;
  visibility: hidden;
  opacity: 0;
  display: flex;
  align-items: left;
  justify-content: center;
  transition: opacity .2s, visibility .2s;
}

.img__wrap:hover .img__description_layer {
  visibility: visible;
  opacity: 1;
}

.img__description {
  transition: .2s;
  transform: translateY(3em);
}

.img__wrap:hover .img__description {
  transform: translateY(20);
}
.ellipsis {
    max-width: 20vh;
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;
}
.ellipsis:hover {
    text-overflow: clip;
    white-space: normal;
    word-break: break-all;
}

</style>
@endpush


@section('content')
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Company</h3>
         </div>
      </div>
      <div class="clearfix"></div>

          <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>{{ $company->name }}  &nbsp;&nbsp;&nbsp;&nbsp; <span>UEN</span> {{$company->uen}}</h2>

                          <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <ul class="stats-overview">
                              <li>
                                  <span class="name"> Date Created </span>
                                  <span class="value text-success" style="font-weight:normal"> {{ date_format($createdTime, 'jS F Y h:i A') }} </span>
                               </li>
                               <li>
                                  <span class="name"> Date Updated </span>
                                  <span class="value text-success"style="font-weight:normal"> {{  date_format($updatedTime, 'jS F Y h:i A') }}</span>
                               </li>
                               <li >
                               <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="name"> Collaborators </span>
                                  <a id="collaborators_button" >
                                    <span class="glyphicon glyphicon-plus-sign gi-1x"></span>
                                   </a>

                                  <ul class="list-inline">
                                    @if(!empty($collaborators))
                                      @foreach($collaborators as $profile)

                                      <div class="img__wrap">
                                      @php
                                      $url = parse_url($profile->profile_pic);
                                      @endphp
                                      @if(!empty($url['scheme']))
                                        <img src="{{ $profile->profile_pic }}" class="avatar" alt="{{ $profile->name }}">
                                      @else
                                        <img src="{{ 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/' . $profile->profile_pic }}" class="avatar" alt="{{ $profile->name }}">
                                      @endif
                                      <div class="img__description_layer">
                                            <p class="img__description">{{ $profile->name }}</p>
                                          </div>
                                        </div>

                                      @endforeach
                                    @endif
                                  </ul>
                                </div>
                                </div>
                                </li>

                               </li>
                            </ul>

                            <div>
                              <div class="x_title">
                              <div>
                              <h2>Contacts</h2>
                              <button type="button" class="btn btn-default btn-sm" id="new-contact-button"  style="float: right; background: #32213A; color: white;">New Contact</button>
                            </div>
                            <div class="clearfix"></div>
                              </div>
                                <div class="x_content">
                                  <div class="table-responsive">
                                   <table id="datatable_contacts" class="account_table table table-striped table-bordered">
                                      <thead>
                                         <tr>
                                            <th>Contact Name</th>
                                            <th>Title</th>
                                            <th>Email</th>
                                            <th>Handphone No.</th>
                                            <th>Telephone No.</th>
                                            <!-- <th>Company</th> -->
                                            <th  style="width: 20%">Actions</th>
                                         </tr>
                                      </thead>
                                      <tbody>
                                         @foreach ($accounts as $account)
                                         <tr>
                                            <td>{{ $account->name }}</td>
                                            <td>{{ $account->title }}</td>
                                            <td>{{ $account->email }}</td>
                                            <td>{{ $account->handphone }}</td>
                                            <td>{{ $account->telephone == null ? "-" : $account->telephone }}</td>
                                           <!-- <td >{{ $account == null ? "-" : $account->company == null ? "-":$account->company->name }}</td> -->
                                            <td>
                                               <a id="account_button" data-id="{{ $account->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Edit</a>
                                               <a onclick="deleteAccount( {{ $account->id }} )" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</a>
                                            </td>
                                         </tr>
                                         @endforeach
                                      </tbody>
                                   </table>
                                  </div>
                                </div>

                            </div>

                            <div>
                              <!-- start vue -->
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <h3 class="text-center title-color">Company's Tasks
                                  <button type="button" class="btn btn-default btn-sm" id="new-task-button"  style="float: right; background: #32213A; color: white;">New Task</button>
                                  </h3>


                                   <div class="well" id="app">
                                     <task-draggable :tasks-open="{{ $tasksOpen }}" :tasks-on-going="{{ $tasksOnGoing }}" :tasks-closed="{{ $tasksClosed }}"></task-draggable>
                                   </div> <!-- end app -->
                               </div>
                              </div>
                              <!-- end vue -->
                            </div>

                            <div class="row" style="padding-bottom: 2em;">
                              <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div>

                                    </div>
                                  </div>
                            </div>

                            <br>

                            <div>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <ul class="nav navbar-right panel_toolbox">
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>


                            </div>



                  <div>
                    <div class="x_title">
                       <h2>Job Lists</h2>
                       <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                       <div class="table-responsive">
                         <table id="datatable_job" class="table table-striped table-bordered dataTables">
                            <thead>
                                 <tr>
                                     <th style="width: 20%">Title</th>
                                     <!-- <th style="width: 20%">Description</th>
                                     <th style="width: 5%">Skills</th> -->
                                     <th style="width: 10%">Industry</th>
                                     <th style="width: 10%">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @foreach($jobs as $job)
                               <tr role="row" class="{{ (($job->id % 2) == 1) ? 'odd':'even'}}">
                                 <td>{{ $job->job_title }}</td>
                                 <td>{{ $job->industry == '' ? '-' : $job->industry }}</td>
                                 <td>
                                 <a onclick="viewjob( {{ $job }}, {{ $company }} )" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View </a>
                                 <a onclick="deletejob( {{ $job }} )" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                 </td>
                               </tr>
                               @endforeach
                             </tbody>
                          </table>
                        </div>
                    </div>
            </div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2>Recent Activities on Company</h2>
                                <div class="clearfix"></div>
                              </div>
                              <div class="content x_content">
                                <ul class="list-unstyled msg_list">
                                  @foreach ($activities as $activity)
                                  <li>
                                    <a>
                                      <span class="image">
                                        <!-- <img src="{{ $activity[0]->profile_pic == null ?  Gravatar::src(Auth::user()->email) : $activity[0]->profile_pic }}" alt="img"> -->
                                      </span>
                                      <span>
                                        <span><strong>{{ $activity[0]->name }}</strong></span>
                                        <span class="time">{{ $activity[2] }}</span>
                                      </span>
                                      <span class="message">
                                        {{ $activity[3] }}
                                      </span>
                                    </a>
                                  </li>
                                  @endforeach

                                </ul>
                              </div>
                            </div>
                        </div>
                            </div>

                            <!-- recent activities -> notes -->
                            <div class="row">

                              <h3>Company Notes</h3>
                                 <div class="x_panel"> <!-- panel -->
                                    {{  Form::open(['route' => ['new.company.post', $company->id],'method'=>'post']) }}
                                      <div class="form-group">
                                        {!! Form::text('body', null, ['class' => 'form-control', 'id' => 'new-post', 'rows' => '5', 'placeholder' => 'Your Notes']) !!}
                                      </div>
                                      {{ Form::submit('Add Note', ['class'=>'btn btn-primary']) }}
                                  {!! Form::close() !!}
                                 </div> <!-- /panel -->
                              <!-- end of user messages -->
                              <ul class="messages">

                                @foreach($notes as $note)
                                <li>

                                  <div class="message_date">
                                      <p class="date text-info">{{ date("d M Y", strtotime($note->created_at))}}</p>
                                  </div>
                                  <div class="message_wrapper">
                                    <h4 class="heading">{{ $note->user->name }}</h4>
                                      <blockquote id="content-{{ $note->id }}" class="message">{{ $note->content }}</blockquote>
                                    @if(Auth::user()->id == $note->user->id)
                                    <div class="pull-right">
                                      <a data-id="{{ $note->id }}" data-content="{{ $note->content }}" class="edit-note" id="Edit-modal" href="#edit-note" style="padding-right: 2em;">
                                        <span class="glyphicon glyphicon-pencil gi-1x"></span>
                                      </a>

                                      <a onclick="deleteNote( {{ $note->id }} )" class="confirmation">
                                        <span class="glyphicon glyphicon-trash gi-1x"></span>
                                      </a>
                                    </div>
                                    @endif
                                    <br>
                                    <p class="url">
                                      <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                      <!-- <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a> -->
                                    </p>
                                  </div>
                                </li>
                                @endforeach
                              </ul>
                              <!-- end of user messages -->


                            </div>
                            <!-- recent activities -> notes -->

                          </div>

                            <!-- start project-detail sidebar -->
                            <div class="col-md-3 col-sm-3 col-xs-12">
                               <section class="panel">
                                  <div class="x_title">
                                     <h2>Company Description</h2>
                                     <div class="clearfix"></div>
                                  </div>
                                  <div class="col-md-12">
                                     <iframe width="100%"
                                        height="auto"
                                        frameborder="0" style="border:0"
                                        src="{{ 'https://www.google.com/maps/embed/v1/place?key=AIzaSyCLy0Kyf98R9LIPXmkrGL-Tqic6-_yVErI&q=' . $company->address }}" allowfullscreen>
                                     </iframe>
                                  </div>
                                  <div class="panel-body">
                                     <div class="project_detail">
                                        <p class="title">Address</p>
                                        <p>{{ $company->address }}</p>
                                        <p class="title">Email</p>
                                        <p>{{ $company->email }}</p>
                                        <p class="title">Telephone No.</p>
                                        <p>{{ $company->telephone_no }}</p>
                                        <p class="title">Industry</p>
                                        <p>{{ $company->industry == '' ? '-': $company->industry }}</p>
                                        <p class="title">Website</p>
                                        <p>
                                           @if($company->website == '')
                                           -
                                           @else
                                           <a href="{{ 'http://' . $company->website }}" target="_blank">{{ $company->website }}</a>
                                           @endif
                                        </p>
                                        <p class="title">No. of Employees</p>
                                        <p>{{ $company->no_employees == '' ? '-': $company->no_employees }}</p>
                                     </div>
                                     <br>
                                     <div class="text-center mtop20">
                                        <a class="edit btn btn-sm btn-warning">Edit Company Profile</a>
                                     </div>
                                     <br>
                                     <h5>Company files <small>(LIMIT 1MB)</small></h5>
                                     <ul class="list-unstyled project_files">
                                        @if(!empty($companyFiles))
                                        @foreach($companyFiles as $file)
                                        <div id="hover_button">
                                           <li >
                                              <a href="{{ route('get.file', ['file'=> $file->id])}}"><i class="
                                                 @php
                                                 switch ($file->file_type) {
                                                 case 'jpg':
                                                 case 'jpeg':
                                                 case 'png':
                                                 echo 'fa fa-picture-o';
                                                 break;
                                                 case 'pdf':
                                                 echo 'fa fa-file-pdf-o';
                                                 break;
                                                 case 'xls':
                                                 case 'xlsx':
                                                 case 'xltm':
                                                 case 'xlsm':
                                                 case 'csv':
                                                 echo 'fa fa-file-excel-o';
                                                 break;
                                                 case 'ppt':
                                                 case 'pptx':
                                                 echo 'fa fa-file-powerpoint-o';
                                                 break;
                                                 case 'doc':
                                                 case 'docx':
                                                 echo 'fa fa-file-word-o';
                                                 break;
                                                 case 'zip':
                                                 case 'rar':
                                                 case '7z':
                                                 echo 'fa fa-file-archive-o';
                                                 break;
                                                 default:
                                                 echo 'fa fa-folder';
                                                 }
                                                 @endphp"></i>{{ $file->file_name }}</a>
                                              <a id="delete_button" href="{{ route('remove.company.file',['file' => $file->id]) }}"><i style="color: red" class="fa fa-remove"></i></a>
                                           </li>
                                        </div>
                                        @endforeach
                                        @endif
                                     </ul>
                                     <br>
                                     <div class="text-center mtop20">
                                        {{  Form::open(['route' => 'update.company.file','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'file_uploader', 'enctype'=>'multipart/form-data']) }}
                                        <input id="file_upload" name="file_upload" type="file"  data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf,image/jpeg, image/pipeg, image/png, image/bmp, image/webp, application/x-7z-compressed, image/gif,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.openxmlformats-officedocument.presentationml.slide,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/plain,application/zip,application/x-rar-compressed, application/vnd.ms-excel,application/vnd.ms-powerpoint	" />
                                        <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
                                        <a href="" id="upload_link" class="btn btn-sm btn-primary">Add file</a>
                                        </form>
                                     </div>
                                  </div>
                               </section>
                            </div>
                                <!-- end project-detail sidebar -->

                        </div>

                      </div>
                    </div>
                  </div>

   </div>
           <div class="modal fade" tabindex="-1" role="dialog" id="edit-note">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           <h4 class="modal-title">Edit Note</h4>
                       </div>
                       <div class="modal-body">
                           <form>
                               <div class="form-group">
                                   <label for="post-body">Edit Note</label>
                                   <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
                               </div>
                           </form>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary" id="modal-note-save">Save changes</button>
                       </div>
                   </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->

           <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Edit Company</h4>
                    </div>
                    <div class="modal-body">
                       {{  Form::open(['route' => 'update.company','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'modal_form_id']) }}
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">Address <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" id="address" name="address" required="required" class="form-control col-md-7 col-xs-12" value="{{ $company->address }}">
                          </div>
                       </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uen">Company UEN</label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="uen" name="uen" value="{{ $company->uen }}" class="form-control col-md-7 col-xs-12">
                         </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="emai">Email <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $company->email }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone_no">Telephone No <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" id="telephone_no" name="telephone_no" required="required" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12" value="{{ $company->telephone_no }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website *
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="url" id="website"  name="website"  class="form-control col-md-7 col-xs-12" value="{{ $company->website }}">
                          </div>
                       </div>
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_employees">No of Employees *
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">

                              <select class="select2_single form-control" id="no_employees" name="no_employees" tabindex="-1">
                                  <option value="0"></option>
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
                                <!-- http://www.themarketingscore.com/blog/bid/317180/18-Possible-Lead-Sources-Your-Organization-Needs-to-Measure -->
                                <option value=""></option>
                                <option value="Affiliate / Partner Programs">Affiliate / Partner Programs</option>
                                <option value="Blogging">Blogging</option>
                                <option value="Digital Advertising">Digital Advertising</option>
                                <option value="Direct Marketing">Direct Marketing</option>
                                <option value="Email Marketing">Email Marketing</option>
                                <option value="Events / Shows">Events / Shows</option>
                                <option value="Inbound Phone Calls">Inbound Phone Calls</option>
                                <option value="Media Coverage">Media Coverage</option>
                                <option value="Organic Search">Organic Search</option>
                                <option value="Others">Others</option>
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
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <textarea class="resizable_textarea form-control" name="description" id="description" placeholder="Type here" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background:transparent!important; margin: 0px 8px 0px 0px; ">{{ $company->description }}</textarea>
                          </div>
                       </div>
                       <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
                       {{ csrf_field() }}
                       </form>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-primary"  onclick="submitform();" >Update Profile</button>
                    </div>
                 </div>
                 <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
           </div>

           <div class="modal fade" tabindex="-1" role="dialog" id="edit-account">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Edit Contact</h4>
                    </div>
                    <div class="modal-body">
                       {{  Form::open(['route' => 'update.account','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'account_form']) }}
                       <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
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
                       <div class="ln_solid"></div>
                       <input type="hidden" id="employee_id" name="employee_id" value="">

                       {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-primary"  onclick="updateAccountForm();" >Update Contact</button>
                    </div>
                 </div>
                 <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
           </div>

           <div class="modal fade" tabindex="-1" role="dialog" id="edit-collaborators">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Edit Collaborators</h4>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive">
                       <table id="datatable_collaborator" class="account_table1 table table-striped table-bordered">
                          <thead>
                             <tr>
                                <th>Name</th>
                                <th  style="width: 5%">Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach($collaborators as $profile)
                            <tr>
                            <td>{{ $profile->name }}</td>
                            <td><a href="{{ route('detach.user',['company'=> $company->id, 'user'=> $profile->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Remove</a></td>
                          </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <div>
                        {{  Form::open(['route' => 'attach.user','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'attach_user']) }}
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Select User</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="select2_single form-control" name="user_id" required="required" tabindex="-1">
                              <option value="">Select a User</option>

                              @foreach($users as $user)
                                @if(!in_array($user->id, $collaboratorsId))
                                <option value="{{ $user-> id}}">{{$user->name}}</option>
                                @endif
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Save</a>
                      </div>
                        </form>
                      </div>
                    </div>
                    <!-- <div class="modal-footer">
                       <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-primary"  onclick="" >Save</button>
                    </div> -->
                 </div>
                 <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
           </div>

           <div class="modal fade" tabindex="-1" role="dialog" id="confirm-delete">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Delete Contact</h4>
                    </div>
                    <div class="modal-body">
                       {{  Form::open(['route' => 'delete.account','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_form']) }}
                       <p>Are you sure you want to delete this contact? This action cannot be undone.</P>
                       <input type="hidden" id="contact_id" name="contact_id" value="">

                       {!! Form::close() !!}

                       <button type="button" class="btn btn-danger"  onclick="submitForm();" >Confirm Delete</button>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>

                 </div>
                 <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
        	 </div>

             <div class="modal fade" tabindex="-1" role="dialog" id="confirm-deleteNote">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Delete Note</h4>
                    </div>
                    <div class="modal-body">
                       {{  Form::open(['route' => 'delete.note','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'delete_formNote']) }}
                       <p>Are you sure you want to delete this note? This action cannot be undone.</P>
                       <input type="hidden" id="postId" name="postId" value="">

                       {!! Form::close() !!}

                       <button type="button" class="btn btn-danger"  onclick="submitFormNote();" >Confirm Delete</button>
                       <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </div>

                 </div>
                 <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
        	 </div>

           <div class="modal fade" tabindex="-1" role="dialog" id="edit-contacts">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">New Contact</h4>
                    </div>
                    <div class="modal-body">
                      {{  Form::open(['route' => 'add.new.account','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Name <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" >
                         </div>
                      </div>

                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title<span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-9 col-xs-12">
                            <input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12" data-parsley-required-message="Please enter a title">

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
                      <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
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

              <!-- for new task button -->
              <div class="modal fade" tabindex="-1" role="dialog" id="edit-tasks">
              <div class="modal-dialog">
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title">Add Task</h4>
                    </div>
                    <div class="modal-body">
                      {{  Form::open(['route' => 'add.new.tasks','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}

                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Task <span class="required">*</span>
                         </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="task" name = "title" required="required" class="form-control col-md-7 col-xs-12">
                         </div>
                       </div>

                      <!-- only admin can see this option -->
                      @if(Auth::user()->admin == 1)
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assigned_id">Assign Consultant</label>
                        <div class="col-md-6 col-sm-9 col-xs-12">
                          <select class="select2_single form-control" name="assigned_id" id="assigned_id" tabindex="-1">
                          <option value='0'>Select a Personel</option>
                            @foreach($users as $user)
                            <option value='{{ $user->id }}'>{{ $user->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      @endif

                      <input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}" class="form-control col-md-7 col-xs-12">

                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Due Date <span class="required">*</span>
                         </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                               <div class="control-group">
                                 <div class="controls">
                                   <div class="input-prepend input-group" >
                                     <!-- <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span> -->
                                     <input type="date" name="date_reminder" id="date_reminder" required="required" class="form-control" value="" />
                                   </div>
                                 </div>
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
              <!-- end of new task button -->

                  <div class="modal fade" tabindex="-1" role="dialog" id="edit-task">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <h4 class="modal-title">Edit Task</h4>
                              </div>
                              <div class="modal-body">
                                 {{  Form::open(['route' => 'edit.task','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'updateTask']) }}

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Task Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                 </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Due Date</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input  type="date"  id="task_date" name="date" data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12">
                                    </div>
                                 </div>


                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Select User</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                    @if(Auth::user()->admin == true)
                                    <select class="select2_single form-control" id="consultant" name="consultant"   tabindex="-1">
                                    @else
                                    <select class="select2_single form-control" id="consultant" name="consultant" disabled tabindex="-1">

                                    @endif
                                    <option id="assigned_user"  selected="selected" value="">Select a User</option>
                                      @foreach($consultants as $user)
                                          <option value="{{ $user-> id }}">{{ $user->name }}</option>
                                      @endforeach
                                      <option value="">No user assigned</option>
                                    </select>
                                  </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company">Company
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <input type="text" readonly id="company" name="company" class="form-control col-md-7 col-xs-12">
                                    </div>
                                 </div>
                                 <div class="ln_solid"></div>
                                 <input type="hidden" id="task_id" name="task_id" value="">
                                 {!! Form::close() !!}
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-primary"  onclick="updateTask();" >Update</button>
                              </div>
                           </div>
                           <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
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

	   <div class="modal fade" tabindex="-1" role="dialog" id="delete-job">
    <div class="modal-dialog">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Delete Job Post</h4>
          </div>
          <div class="modal-body">
             {{  Form::open(['route' => 'delete.job','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'deletejob_form']) }}
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
              <!-- recent activities -> notes -->
@endsection

@section('bottom_content')

@endsection

@push('scripts')

<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>

<!-- Autosize -->
<script src="{{ asset('js/autosize.min.js') }}"></script>
<script>
//route didnt work
var token = '{{ Session::token() }}';
var urlEdit = "{{ route('update.company') }}";
var postData = new FormData($("#modal_form_id")[0]);
var ar = {!! json_encode($users) !!};

// ======= START OF FILES =======
$(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#file_upload:hidden").trigger('click');
    });
});

$('#file_uploader').on('change','#file_upload' , function(){
    $('#file_uploader').submit();
 });

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

    $('#upload').parsley();

}(jQuery, app));

// ======= END OF FILES =======

function submitform()
{
  $('#modal_form_id').submit();
}

function updateAccountForm(){
  $('#account_form').submit();
}

function deleteAccount(employeeId) {
  $('#contact_id').val(employeeId);
  $('#confirm-delete').modal('show');
}

function submitForm() {
    $('#delete_form').submit();
}

function deleteNote(noteId) {
  $('#postId').val(noteId);
  $('#confirm-deleteNote').modal('show');
}

function submitFormNote() {
    $('#delete_formNote').submit();
}

function viewjob(job, company) {
  $('#company_name1').html(company.name);
  $('#company_id1').html(job.company_id);
  $('#job_title1').html(job.job_title);
  $('#job_description1').html(job.job_description);
  $('#skills1').html(job.skills);
  $('#tags1').html(job.summary_keywords);

   $('#view-job').modal('show');
}

function deletejob(job) {
  $('#job').val(job.id);
  $('#delete-job').modal('show');
}

function deleteJob() {
  $('#deletejob_form').submit();
}

$(document).ready(function () {

  $(".edit").click(function () {
      var companyEmployees = "{{ $company->no_employees }}";
      var emLen = document.getElementById("no_employees").length;
      for (var i=0; i<emLen; i++) {
        var emVal = document.getElementById("no_employees").options[i].text;
        if (emVal == companyEmployees) {
          document.getElementById("no_employees").options[i].selected = true;
        }
      }

      var companyIndustry = "{{ $company->industry }}";
      var inLen = document.getElementById("industry").length;
      for (var i=0; i<inLen; i++) {
        var inVal = document.getElementById("industry").options[i].text;
        if (inVal == companyIndustry) {
          document.getElementById("industry").options[i].selected = true;
        }
      }

      var companyLead = "{{ $company->lead_source }}";
      var leadLen = document.getElementById("lead_source").length;
      for (var i=0; i<leadLen; i++) {
        var leadVal = document.getElementById("lead_source").options[i].text;
        if (leadVal == companyLead) {
          document.getElementById("lead_source").options[i].selected = true;
        }
      }

      $('#edit-modal').modal('show');
    });

    $("#modal_form_id").submit(function (e) {

     $.ajax({
      type: 'POST',
      url: urlEdit,
      processData: false,
      contentType: false,
      data:  {
        company_id:$('#company-id').val(),
        email: $('#email').val(),
        telephone_no: $('#telephone_no').val(),
        address: $('#address').val(),
        industry: $('#industry').val(),
        website: $('#website').val(),
        description: $('#description').val(),
        no_employees: $('#no_employees').val(),
        _token:token
      },
      success: function(resultData) {
          window.location.reload();
           }
        });
      });

       $(".account_table").on('click','#account_button',function(){
           var currentRow=$(this).closest("tr");

           var name=currentRow.find("td:eq(0)").text();
           var title=currentRow.find("td:eq(1)").text();
           var email=currentRow.find("td:eq(2)").text();
           var handphone=currentRow.find("td:eq(3)").text();
           var telephone=currentRow.find("td:eq(4)").text();
           if(telephone == '-'){
            telephone = '';
           }

          $('#account_form').find('input[name=name]').val(name);
          $('#account_form').find('input[name=title]').val(title);

           $('#account_form').find('input[name=email]').val(email);
           $('#account_form').find('input[name=handphone]').val(handphone);
           $('#account_form').find('input[name=telephone]').val(telephone);
           $('#account_form').find('input[name=employee_id]').val($(this).data("id"));

           $('#edit-account').modal('show');
      });
  });


  $(document).ready(function () {
    $('.ui-pnotify').remove();
      loadNotification();

      $("#collaborators_button").click(function () {
          $('#edit-collaborators').modal('show');
        });

      $("#new-contact-button").click(function () {
        $('#edit-contacts').modal('show');
      });

      $("#new-task-button").click(function () {
        $('#edit-tasks').modal('show');
      });
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

  var urlEdit = `{{ route('edit.note') }}`;
  var postId = 0;

  $(document).ready(function () {
    $(".edit-note").click(function () {
        postId = $(this).data('id');
        $('#post-body').val($(this).data('content'));
        $('#edit-note').modal('show');
      });

      //Pending for a more modern way to solve this
      $("#modal-note-save").click(function () {
        var saveData = $.ajax({
        type: 'POST',
        url: urlEdit,
        data:  {id: postId, content: $('#post-body').val(), _token:token},
        dataType: "text",
        success: function(resultData) {
            var message = JSON.parse(resultData);
            console.log(message.updated_content);
            $('#content-' + postId).text(message.updated_content);
            new PNotify({
                title: "Success!",
                text: "Company note is succesfully updated!",
                type: "success",
                styling: 'bootstrap3'
            });
            $('#edit-note').modal('hide');
          },
          fail: function(xhr, textStatus, errorThrown){
            new PNotify({
                title: "Something happened!",
                text: "Company note cant be updated",
                type: "error",
                styling: 'bootstrap3'
            });
            $('#edit-note').modal('hide');
          }
        });
      });
    });


    function updateTask(){
      $('#updateTask').submit();
    }


    function editTask(e) {
      var task_id = e.getAttribute('data-id');
      var task_title = e.getAttribute('data-title');
      var task_desc = e.getAttribute('data-desc');
      var task_date = new Date(e.getAttribute('data-date'));
      task_date.setDate(task_date.getDate() + 1);

      var task_company = e.getAttribute('data-company');
      var task_assignee = e.getAttribute('data-assignee');
      var task_creator = e.getAttribute('data-creator');

      $('#updateTask').find('input[name=task_id]').val(task_id);
      $('#updateTask').find('input[name=title]').val(task_title);
      $('#updateTask').find('input[name=company]').val(task_company);
      $('#updateTask').find('input[name=description]').val(task_desc);

      document.getElementById("task_date").valueAsDate = task_date;

      if(task_assignee === ""){
        document.getElementById("assigned_user").value = '';
        document.getElementById("assigned_user").text = 'Select a User';
      }else{
        for (var i = 0; i < ar.length; i++) {
          if(ar[i].name == task_assignee){
              document.getElementById("assigned_user").value = ar[i].id;
              document.getElementById("assigned_user").text = task_assignee;
          }
        }
       }

      $('#edit-task').modal('show');
  }
</script>

<script>
$(document).ready(function() {

    $('#datatable_job').DataTable();


} );
</script>
<script src="{{ asset('js/vue-app-compiled.js') }}"></script>
<script src="{{ asset('js/pnotify.js') }}"></script>
<script src="{{ asset('js/pnotify.buttons.js') }}"></script>
<script src="{{ asset('js/pnotify.nonblock.js') }}"></script>
<script src="{{ asset('js/echarts.min.js') }}"></script>
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

@endpush
