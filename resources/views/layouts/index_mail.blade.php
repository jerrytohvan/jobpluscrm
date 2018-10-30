@extends('layouts.master')

@push('stylesheets')
<!-- bwysiwyg -->
<link href="{{ asset('css/prettify.min.css') }}" rel="stylesheet">
@endpush


@section('content')
<!-- page content -->

<div class="right_col" role="main">
  <div class="clearfix">

    <div class="page-title">
      <div class="title_left">
        <h3>Mail</h3><small>Click Button to send a mail </small></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        </div>
      </div>
    </div>

    <div class="clearfix"></div>

     <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>New Mail<small></small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-3 mail_list_column">
                <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
     <div class="col-md-12">
       <div class="x_panel">
         <div class="x_title">
           <h2>Access External Inbox<small></small></h2>
           <div class="clearfix"></div>
         </div>
         <div class="x_content">
           <div class="row">
             <div class="col-sm-3 mail_list_column">
               <a href="https://mail.google.com/mail/u/2/#inbox" class="btn btn-sm btn-success btn-block" target="_blank">Go to Inbox</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
          <!--        <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                    </div>
                    <div class="right">
                      <h3>Dennis Mugo <small>3.00 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="right">
                      <h3>Jane Nobert <small>4.09 PM</small></h3>
                      <p><span class="badge">To</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-circle-o"></i><i class="fa fa-paperclip"></i>
                    </div>
                    <div class="right">
                      <h3>Musimbi Anne <small>4.09 PM</small></h3>
                      <p><span class="badge">CC</span> Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-paperclip"></i>
                    </div>
                    <div class="right">
                      <h3>Jon Dibbs <small>4.09 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      .
                    </div>
                    <div class="right">
                      <h3>Debbis & Raymond <small>4.09 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      .
                    </div>
                    <div class="right">
                      <h3>Debbis & Raymond <small>4.09 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                    </div>
                    <div class="right">
                      <h3>Dennis Mugo <small>3.00 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
                <a href="#">
                  <div class="mail_list">
                    <div class="left">
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="right">
                      <h3>Jane Nobert <small>4.09 PM</small></h3>
                      <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis nostrud exercitation...</p>
                    </div>
                  </div>
                </a>
              </div> -->
              <!-- /MAIL LIST -->

              <!-- CONTENT MAIL
              <div class="col-sm-9 mail_view">
                <div class="inbox-body">
                  <div class="mail_heading row">
                    <div class="col-md-8">
                      <div class="btn-group">
                        <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                        <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                        <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                        <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                      </div>
                    </div>
                    <div class="col-md-4 text-right">
                      <p class="date"> 8:02 PM 12 FEB 2014</p>
                    </div>
                    <div class="col-md-12">
                      <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum.</h4>
                    </div>
                  </div>
                  <div class="sender-info">
                    <div class="row">
                      <div class="col-md-12">
                        <strong>Jon Doe</strong>
                        <span>(jon.doe@gmail.com)</span> to
                        <strong>me</strong>
                        <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="view-mail">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                      Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                    <p>Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                      nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                      mollit anim id est laborum.</p>
                    <p>Modesed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                      velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  </div>
                  <div class="attachment">
                    <p>
                      <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                      <a href="#">Download all attachments</a> |
                      <a href="#">View all images</a>
                    </p>
                    <ul>
                      <li>
                        <a href="#" class="atch-thumb">
                          <img src="images/inbox.png" alt="img" />
                        </a>

                        <div class="file-name">
                          image-name.jpg
                        </div>
                        <span>12KB</span>


                        <div class="links">
                          <a href="#">View</a> -
                          <a href="#">Download</a>
                        </div>
                      </li>

                      <li>
                        <a href="#" class="atch-thumb">
                          <img src="images/inbox.png" alt="img" />
                        </a>

                        <div class="file-name">
                          img_name.jpg
                        </div>
                        <span>40KB</span>

                        <div class="links">
                          <a href="#">View</a> -
                          <a href="#">Download</a>
                        </div>
                      </li>
                      <li>
                        <a href="#" class="atch-thumb">
                          <img src="images/inbox.png" alt="img" />
                        </a>

                        <div class="file-name">
                          img_name.jpg
                        </div>
                        <span>30KB</span>

                        <div class="links">
                          <a href="#">View</a> -
                          <a href="#">Download</a>
                        </div>
                      </li>

                    </ul>
                  </div>
                  <div class="btn-group">
                    <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                    <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                    <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                  </div>
                </div>

              </div>
               /CONTENT MAIL -->


</div>
<!-- /page content -->
@endsection

@section('bottom_content')
<!-- compose -->


<div class="compose col-md-6 col-xs-12">
  <div class="compose-header">
    New Message
    <button type="button" class="close compose-close">
      <span>×</span>
    </button>
  </div>

  <div class="compose-body">
    <div id="alerts"></div>

    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
        <ul class="dropdown-menu">
        </ul>
      </div>

      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li>
            <a data-edit="fontSize 5">
              <p style="font-size:17px">Huge</p>
            </a>
          </li>
          <li>
            <a data-edit="fontSize 3">
              <p style="font-size:14px">Normal</p>
            </a>
          </li>
          <li>
            <a data-edit="fontSize 1">
              <p style="font-size:11px">Small</p>
            </a>
          </li>
        </ul>
      </div>

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




        {{  Form::open(['route' =>'sendemail', 'method'=>'post','id'=>'submit-email','files'=> true,'enctype'=>'multipart/form-data']) }}

        <!-- {{  Form::open(['route' =>'sendemail', 'method'=>'post','id'=>'submit-email','enctype'=>'multipart/form-data']) }} -->






    <!--  <div class="form-group">
        <a class="btn" title="Insert picture (or just drag & drop)" id="emailAttachment"><i class="fa fa-picture-o"></i></a>
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
      </div> -->


      </div>

      <div class="form-group">
        {!! Form::label('emailAttachment', 'Upload Attachment:(only 1 at a time)') !!}
        {!! Form::file('emailAttachment', null, ['class' => 'form-control']) !!}
      </div>

      <div class="form-group">
      <label for="toEmail">TO*: (comma seperated email addresses)</label>
      <input type="email" id="toEmail" multiple pattern="^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$"  class="form-control parseley-error" data-parsley-trigger="change" name="toEmail" required="required" >
    </div>

    <div class="form-group">
    <label for="ccEmail">CC: (comma seperated email addresses)</label>
    <input type="email" id="ccEmail" multiple pattern="^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$" class="form-control" name="ccEmail" data-parsley-trigger="change" >
    </div>


    <div class="form-group">
    <label for="subject">Subject * :</label>
    <input type="text" id="subject" class="form-control parsley-error" name="subject" data-parsley-trigger="change" required="required">
    </div>

  <div class="form-group">
      <div id="editor"  class="editor-wrapper"></div>
      <input type="hidden" id="emailMessage" value="" name="emailMessage"/>
</div>
   <div class="compose-footer">
  {{ Form::submit('Send', ['class'=>'btn btn-sm btn-success']) }}
  </div>
                {!! Form::close() !!}
</div>



<!-- /compose -->
@endsection

@push('scripts')
<script>
$(function() {
    $('#submit-email').on("submit",function(e) {
        $('#emailMessage').val($('#editor').text());
    $('#submit-email').submit();
  });
});







</script>
<script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('js/prettify.js') }}"></script>


@endpush
