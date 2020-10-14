<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" href="favicon_16.ico"/>
  <link rel="bookmark" href="favicon_16.ico"/>
  <!-- site css -->
  <link rel="stylesheet" href="{{ _backend_assets('css/site.min.css') }}">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  <!-- <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
  <!--[if lt IE 9]>
  <script src="{{ _backend_assets('js/html5shiv.js') }}"></script>
  <script src="{{ _backend_assets('js/respond.min.js') }}"></script>
  <![endif]-->
  <script src="{{ _backend_assets('js/site.min.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>
<body>
<!--nav-->
<nav role="navigation" class="navbar navbar-custom">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand">Bootflat-Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="getting-started.html">Getting Started</a></li>
        <li class="active"><a href="index.html">Documentation</a></li>
        <!-- <li class="disabled"><a href="#">Link</a></li> -->
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">Silverbux <b class="caret"></b></a>
          <ul role="menu" class="dropdown-menu">
            <li class="dropdown-header">Setting</li>
            <li><a href="#">Action</a></li>
            <li class="divider"></li>
            <li class="active"><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li class="disabled"><a href="#">Signout</a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--header-->
<div class="container-fluid">
  <!--documents-->
  <div class="row row-offcanvas row-offcanvas-left">
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
      <ul class="list-group panel">
        <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
        <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
        <li class="list-group-item"><a href="{{ route('admin.dashboard') }}"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>
        <li>
          <a href="#main_menu" class="list-group-item " data-toggle="collapse">{{ __('backend/menu.main_menu') }}  <span class="glyphicon glyphicon-chevron-right"></span></a>
          <div class="collapse" id="main_menu">
            <a href="{{ route('admin.main-category.index') }}" class="list-group-item">{{ __('backend/menu.main_menu_list') }}</a>
          </div>
        </li>
        <li class="list-group-item"><a href="{{ route('admin.main-category.index') }}"><i class="glyphicon glyphicon-certificate"></i>Menu chính </a></li>
        <li class="list-group-item"><a href="list.html"><i class="glyphicon glyphicon-th-list"></i>Tables and List </a></li>
        <li class="list-group-item"><a href="forms.html"><i class="glyphicon glyphicon-list-alt"></i>Forms</a></li>
        <li class="list-group-item"><a href="alerts.html"><i class="glyphicon glyphicon-bell"></i>Alerts</li>
        <li class="list-group-item"><a href="timeline.html" ><i class="glyphicon glyphicon-indent-left"></i>Timeline</a></li>
        <li class="list-group-item"><a href="calendars.html" ><i class="glyphicon glyphicon-calendar"></i>Calendars</a></li>
        <li class="list-group-item"><a href="typography.html" ><i class="glyphicon glyphicon-font"></i>Typography</a></li>
        <li class="list-group-item"><a href="footers.html" ><i class="glyphicon glyphicon-minus"></i>Footers</a></li>
        <li class="list-group-item"><a href="panels.html" ><i class="glyphicon glyphicon-list-alt"></i>Panels</a></li>
        <li class="list-group-item"><a href="navs.html" ><i class="glyphicon glyphicon-th-list"></i>Navs</a></li>
        <li class="list-group-item"><a href="colors.html" ><i class="glyphicon glyphicon-tint"></i>Colors</a></li>
        <li class="list-group-item"><a href="flex.html" ><i class="glyphicon glyphicon-th"></i>Flex</a></li>
        <li class="list-group-item"><a href="login.html" ><i class="glyphicon glyphicon-lock"></i>Login</a></li>
        <li>
          <a href="#demo3" class="list-group-item " data-toggle="collapse">Item 3  <span class="glyphicon glyphicon-chevron-right"></span></a>
          <div class="collapse" id="demo3">
            <a href="#SubMenu1" class="list-group-item" data-toggle="collapse">Subitem 1  <span class="glyphicon glyphicon-chevron-right"></span></a>
            <div class="collapse list-group-submenu" id="SubMenu1">
              <a href="#" class="list-group-item">Subitem 1 a</a>
              <a href="#" class="list-group-item">Subitem 2 b</a>
              <a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse">Subitem 3 c <span class="glyphicon glyphicon-chevron-right"></span></a>
              <div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">
                <a href="#" class="list-group-item">Sub sub item 1</a>
                <a href="#" class="list-group-item">Sub sub item 2</a>
              </div>
              <a href="#" class="list-group-item">Subitem 4 d</a>
            </div>
            <a href="javascript:;" class="list-group-item">Subitem 2</a>
            <a href="javascript:;" class="list-group-item">Subitem 3</a>
          </div>
        </li>
        <li>
          <a href="#demo4" class="list-group-item " data-toggle="collapse">Item 4  <span class="glyphicon glyphicon-chevron-right"></span></a>
        <li class="collapse" id="demo4">
          <a href="" class="list-group-item">Subitem 1</a>
          <a href="" class="list-group-item">Subitem 2</a>
          <a href="" class="list-group-item">Subitem 3</a>
        </li>
        </li>
      </ul>
    </div>
    <div class="col-xs-12 col-sm-9 content">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a></h3>
        </div>
        <div class="panel-body">
          @yield('body')
        </div>
      </div>
    </div>
  </div>
</div>
@yield('script')
<script>
  $(document).ready(function () {
    $('.row-offcanvas-left').removeClass('active');
  })
</script>
</body>
</html>
