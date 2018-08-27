@extends('layouts.master')


@push('stylesheets')
<link href="{{ asset('css/normalize.css') }}" rel="stylesheet">

<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>


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
/* #upload_link{
    text-decoration:none;
} */
#file_upload{
    display:none;
}

#hover_button:hover a ~ #delete_button{
    display: inline-block;
}
#delete_button {
  display: none;

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
                          <h2>{{ $company->name }}</h2>

                          <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <ul class="stats-overview">
                               <li>
                                  <span class="name"> Date Create </span>
                                  <span class="value text-success"> {{ date_format($company->created_at, 'jS F Y h:i A') }} </span>
                               </li>
                               <li>
                                  <span class="name"> Date Updated </span>
                                  <span class="value text-success"> {{  date_format($company->updated_at, 'jS F Y h:i A') }}</span>
                               </li>
                               <li class="hidden-phone">
                                  <span class="name"> Total Transactions </span>
                                  <span class="value text-success"> 0 </span>
                               </li>
                            </ul>

                            <br>

                            <div>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                 <h2> Accounts & Leads</h2>
                                 <ul class="nav navbar-right panel_toolbox">
                                 </ul>
                                 <div class="clearfix"></div>
                              </div>

                              <div class="x_content">
                                 <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                       <li role="presentation" class="active"><a href="#tab_account" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Acconts</a>
                                       </li>
                                       <li role="presentation" class=""><a href="#new_account" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">New Account</a>
                                       </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                       <div role="tabpanel" class="tab-pane fade active in" id="tab_account" aria-labelledby="home-tab">
                                         <div class="table-responsive">
                                          <table id="datatable" class="account_table table table-striped table-bordered">
                                             <thead>
                                                <tr>
                                                   <th>Account Name</th>
                                                   <th>Title</th>
                                                   <th>Email</th>
                                                   <th>Handphone No.</th>
                                                   <th>Telephone No.</th>
                                                   <th>Company</th>
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
                                                   <td >{{ $account == null ? "-" : $account->company == null ? "-":$account->company->name }}</td>
                                                   <td>
                                                      <a id="account_button" data-id="{{ $account->id }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>Edit</a>
                                                      <a href="{{ route('delete.account', ['employee_id' => $account->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>Delete</a>
                                                   </td>
                                                </tr>
                                                @endforeach
                                             </tbody>
                                          </table>
                                        </div>

                                       </div>
                                       <div role="tabpanel" class="tab-pane fade" id="new_account" aria-labelledby="profile-tab">
                                          {{  Form::open(['route' => 'add.new.account','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left']) }}
                                          <div class="form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Account Name <span class="required">*</span>
                                             </label>
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
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
                            </div>

                            <br/>
                            <br/>

                            <div>

                              <h4>Recent Activity</h4>

                              <!-- end of user messages -->
                              <ul class="messages">
                                <li>
                                  <img src="images/img.jpg" class="avatar" alt="Avatar">
                                  <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                  </div>
                                  <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br>
                                    <p class="url">
                                      <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                      <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                    </p>
                                  </div>
                                </li>
                                <li>
                                  <img src="images/img.jpg" class="avatar" alt="Avatar">
                                  <div class="message_date">
                                    <h3 class="date text-error">21</h3>
                                    <p class="month">May</p>
                                  </div>
                                  <div class="message_wrapper">
                                    <h4 class="heading">Brian Michaels</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br>
                                    <p class="url">
                                      <span class="fs1" aria-hidden="true" data-icon=""></span>
                                      <a href="#" data-original-title="">Download</a>
                                    </p>
                                  </div>
                                </li>
                                <li>
                                  <img src="images/img.jpg" class="avatar" alt="Avatar">
                                  <div class="message_date">
                                    <h3 class="date text-info">24</h3>
                                    <p class="month">May</p>
                                  </div>
                                  <div class="message_wrapper">
                                    <h4 class="heading">Desmond Davison</h4>
                                    <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                    <br>
                                    <p class="url">
                                      <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                      <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                    </p>
                                  </div>
                                </li>
                              </ul>
                              <!-- end of user messages -->


                            </div>


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
                                      <p class="title">Company Name</p>
                                      <p>{{ $company->name }}</p>
                                      <p class="title">Address</p>
                                      <p>{{ $company->address }}</p>
                                      <p class="title">Email</p>
                                      <p>{{ $company->email }}</p>
                                      <p class="title">Telephone No.</p>
                                      <p>{{ $company->telephone_no }}</p>
                                      <p class="title">Fax No.</p>
                                      <p>{{ $company->fax == '' ? '-': $company->fax }}</p>
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
                                   <h5>Company files</h5>
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
   <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal"> -->
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
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax_no">Fax No
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="text" id="fax_no" name="fax_no"  data-parsley-minlength="6" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" class="form-control col-md-7 col-xs-12" value="{{ $company->fax_no }}">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="url" id="website"  name="website"  class="form-control col-md-7 col-xs-12" value="{{ $company->website }}">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_employees">No of Employees
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input type="number" id="no_employees"  name="no_employees"  class="form-control col-md-7 col-xs-12" value="{{ $company->no_employees }}">
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="industry">Industry</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <select class="select2_single form-control" required="required" id="industry" name="industry" tabindex="-1">
                        <option value="{{ $company->industry }}">{{  $company->industry }}</option>
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
                     <select class="select2_single form-control" required="required" id="lead_source" name="lead_source" tabindex="-1">
                        <option value="{{  $company->lead_source }}">{{  $company->lead_source }}</option>
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
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <textarea class="resizable_textarea form-control" value="{{ $company->description }}" name="description" id="description" placeholder="Type here" style="z-index: auto; position: relative; line-height: 20px; font-size: 14px; transition: none; background:transparent!important; margin: 0px 8px 0px 0px; "></textarea>
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
               <h4 class="modal-title">Edit Account</h4>
            </div>
            <div class="modal-body">
               {{  Form::open(['route' => 'update.account','method'=>'post', 'data-parsley-validate', 'class' => 'form-horizontal form-label-left', 'id'=>'account_form']) }}
               <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Account Name <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                     <input disabled type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
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
               <div class="ln_solid"></div>
               <input type="hidden" id="employee_id" name="employee_id" value="">

               {!! Form::close() !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary"  onclick="updateAccountForm();" >Update Account</button>
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

<!-- Parsley -->
<script src="{{ asset('js/parsley.min.js') }}"></script>

<!-- Autosize -->
<script src="{{ asset('js/autosize.min.js') }}"></script>
<script>
//route didnt work
var token = '{{ Session::token() }}';
var urlEdit = "{{ route('update.company') }}";
var postData = new FormData($("#modal_form_id")[0]);

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

$(document).ready(function () {
  $(".edit").click(function () {
      $('#edit-modal').modal('show');
    });

    $("#modal_form_id").submit(function (e) {

     $.ajax({
      type: 'POST',
      url: urlEdit,
      processData: false,
      contentType: false,
      data:  {
        company_id:$('#comapany-id').val(),
        email: $('#email').val(),
        telephone_no: $('#telephone_no').val(),
        fax_no: $('#fax_no').val(),
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
  });


  $(document).ready(function(){
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
            $('#account_form').find('#title option[value=""]').text(title);
            $('#account_form').find('#title option[value=""]').val(title);

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
</script>



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
<!-- jszip -->
<script src="{{ asset('js/jszip.min.js') }}"></script>
<!-- pdfmake -->
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>

@endpush
