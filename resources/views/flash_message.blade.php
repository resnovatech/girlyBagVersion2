<style>
    .alert {
      padding: 20px;
      background-color: #f44336;
      color: white;
    }


    .alert1 {
      padding: 20px;
      background-color: #0a8676;
      color: white;
    }



    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }
    </style>


@if ($message = Session::get('success'))

<div class="alert1">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>success!</strong> {{ $message }}
  </div>

@endif

@if ($message = Session::get('error'))
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Danger!</strong>
   {{ $message }}
  </div>
@endif

@if ($message = Session::get('warning'))
<div class="alert1">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>success!</strong> {{ $message }}
  </div>
@endif

@if ($message = Session::get('info'))
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>success!</strong> {{ $message }}
  </div>
@endif

@if ($errors->any())
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Danger!</strong>
    @if ($errors->has('email'))
   {{ $errors->first('email') }} <br>
@endif
@if ($errors->has('password'))
{{ $errors->first('password') }} <br>
@endif
  </div>
@endif
