@push('stylesheets')
<!-- bwysiwyg -->
<link href="{{ asset('css/prettify.min.css') }}" rel="stylesheet">
@endpush


<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            @php
            $url = parse_url(Auth::user()->profile_pic);
            @endphp
            @if(!empty($url['scheme']))
            <img src="{{ Auth::user()->profile_pic }}" alt="Avatar">
            @else
            <img src="{{ 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . Auth::user()->profile_pic }}" alt="Avatar">
            @endif

            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="{{ route('show.profile') }}"> Profile</a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

        <li role="presentation" id="newEmail" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o" style="font-size:1.5em;"></i>
            <span  class="badge bg-purple"style="font-size:0.5em;">New</span>
          </a>
        </li>

        <li role="presentation" class="dropdown" id="inbox">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <img style="width: 1.5em;height:auto;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAARbSURBVGhD7ZjbT1xVFMZ5M/E/8C9pE31oU/qkDZamWsNEilWrKEpomhIvNGmot15iiVqNt1YxUtISIibY2BpJJCkMaimMZWa4zH3OPgyXysyjLPc3OefMnpk1cGY4h/JwVvJLJsPa3/q+OXvvAeq88sorr7zaEbV+6dIjWirlSyQS7+5E4A0eDbt8ab1XA6K5iTJd71A2maBcLrejgCd4E80+Er3fTxm2iyt9re+W1vAkmYimZ2n1t9us4MMAXuBJ9Sg93zTsF0q0t62rTSaZ8x9SLpNhxbcFORseOG+i400y7BdKHGtmm4F+7Cg9mPDzg1wEMzGb8wTg2bBfqNTJE2yzxdNP0fKXX1B2dZUd6iSYgVmYyXoxgGfDfqH89fXr6Y52doGK3tZKa8EZ1oATQBszuNkq6RPtNLF/f3mQ8T171sd37aLIG22kPdPILjYRhw/SSv81ymWzrJmakFrQhDY300J6g0d49e/dWzkICBxqJNH6Mi+ksPjWKVqLxXhjVQANaHEzVOAJ3kyfmwYBE088TukL50g7eIAVtXjuMD349SZr0A5YCw1W2wQeLp7Pe1I92goCAv39FL19i8QLlW80k6UPzlJW11mzHOjFGk5LBbOTI79TcGCgyBuwHWTmxg0KBoMUvjdJ4r1udpCK3vI8/Tt2hzWugh70choq+vtnKSYPfyQS2VoQLJ6fn8+HAYmB66Qd2WQb4Jr+/FPKrqyUBcB7+Nlm12p+xk+D+QAmWw4CkdnZWSvMPL6kTnbwBhT01uO0Fpi2QuA13uN6VaAdn7xbFMKxICAcDlthgvfvU/qbr0hrbGDNmIhDDbTy4w958JrrsZBa+tVvKSJ3gBrAxLEgCwsLFAqFCmEk0ZEREsdf5I1VATSSo6NFxktxLAhQz4vJbCBA4sJHrEE76BfPUVR+QOocDkeDAC4MSPw8RMJ3hDXLke/9ZbhMvxKOBwHq4VeZ++tPEja+ofW3Oyk+PcVqV8KVIKDo8KvMzFC69zv2dya8p8uDH5HnjdPcCNeCgIphJJHRP0i89ooVQn/9VUqOj7E6dnA1CG4yLoRJSF4EWs/HpH/SQ7G5OVbDLq4GATj8pdeyCZ5YPB5n11WL60HAnPy0S0PgaUWjUba/FrYlCFBvMicDmGxbEIAn49RWKmXbgiQSCVpcXHTlaQDXg8C4pmm0vLycx60wrgaJyb+1M5mMFcIEwbj+reBaEGylpaWlshAmyWSSXVcrrgRRt9JGOHnwbQfx19f/V9pYGqTSVqoEep06L1wQ9h90fzc1ZUob1SCpVIo1uxm6rhcZqhUuyN2WlvIg011dp8Z37y5qNIMIIViTdkmn02XGqqUsiPQa6uu7Y9gvrsnOzh7/vn3WFgsPDla1lTYClwNn0C5qEGyp4JUrC4ZtviZOn350qrv7wL0zZ3zRsbGj8mD7HOIlefg/k+fsci1EJie/lmGuh4eGLv8zPPyYYdcrr7zyyquHWXV1/wNpZ38BW+CXNQAAAABJRU5ErkJggg==">
              <span class="badge bg-purple" style="font-size:0.5em;">Open</span>
            </a>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>










<!-- hidden model-->




<div class="modal fade" tabindex="-1" role="dialog" id="new-email">
<div class="modal-dialog">
   <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>




                <div class="compose-header">
                  New Message
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
          </div>
        </div>
      </div>

      @push('scripts')
      <script>
      $(function() {
          $('#submit-email').on("submit",function(e) {
              $('#emailMessage').val($('#editor').text());
          $('#submit-email').submit();
        });
      });


  $(document).ready(function () {

          $("#newEmail").click(function () {
              $('#new-email').modal('show');
            });
            $("#inbox").click(function () {
              window.open("https://mail.google.com/mail/u/?authuser={{Auth::user()->email}}", "_blank");
              });
          });

      </script>

@endpush
