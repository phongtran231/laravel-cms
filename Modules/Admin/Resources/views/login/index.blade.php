<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Bootflat-Admin Template</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <!-- site css -->
  <link rel="stylesheet" href="{{ _backend_assets('css/site.min.css') }}">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
  <!--[if lt IE 9]>
  <script src="{{ _backend_assets('js/html5shiv.js') }}"></script>
  <script src="{{ _backend_assets('js/respond.min.js') }}"></script>
  <![endif]-->
  <script type="text/javascript" src="{{ _backend_assets('js/site.min.js') }}"></script>
  <style>
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #303641;
      color: #C1C3C6
    }
  </style>
</head>
<body>
<div class="container">
  <form class="form-signin" method="post" action="{{ route('admin.login') }}">
    {{ csrf_field() }}
    <h3 class="form-signin-heading">{{ __('backend/login.login_title') }}</h3>
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          <p>{!! $error !!}</p>
        @endforeach
      </div>
    @endif
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-addon">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <input type="text" class="form-control" name="username" id="username" placeholder="{{ __('backend/login.username') }}" autocomplete="off" value="{{ old('username') }}" />
      </div>
    </div>

    <div class="form-group">
      <div class="input-group">
        <div class="input-group-addon">
          <i class=" glyphicon glyphicon-lock "></i>
        </div>
        <input type="password" class="form-control" name="password" placeholder="{{ __('backend/login.password') }}" autocomplete="off" />
      </div>
    </div>

    <label class="checkbox">
      <input type="checkbox" value="1"> &nbsp {{ __('backend/login.remember') }}
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('backend/login.sign_in') }}</button>
  </form>

</div>
</body>
</html>
