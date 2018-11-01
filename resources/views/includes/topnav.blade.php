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

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o" style="font-size:1.5em;"></i>
            <span class="badge bg-purple" style="font-size:0.5em;">New</span>
          </a>
        </li>

        <li role="presentation" class="dropdown">
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
