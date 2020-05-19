<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{__('text.title')}}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('../css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('../css/_all-skins.min.css')}}">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('../css/toastr.min.css')}}">
  @yield('css')
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a class="logo">
        <span class="logo-mini"><b>{{__('text.apv')}}</b></span>
        <span class="logo-lg"><b>{{__('text.altplus')}}</b></span>
      </a>
      <nav class="navbar navbar-static-top">
        <a class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset(Auth::user()->avatar) }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                  <p>
                    {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a class="btn btn-default btn-flat">{{__('text.profile')}}</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat">{{__('text.signout')}}</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset(Auth::user()->avatar) }}" class="user-image" alt="User Image">
            </div>
            <div class="pull-left info">
              <span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}
              </span>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">{{__('text.mainnav')}}</li>
          <li class="treeview">
            <a>
              <i class="fa fa-dashboard"></i> <span>{{__('text.user_skill')}}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{asset('')}}userskill"><i class="fa fa-circle-o"></i> {{__('text.list_userskill')}}</a></li>
              <li><a href="{{asset('')}}userskillup"><i class="fa fa-circle-o"></i> {{__('text.list_skillup')}}</a></li>
            </ul>
          </li>
          <li class="">
            <a href="{{route('level')}}">
              <i class="fa fa-circle-o" aria-hidden="true"></i> <span>{{__('text.level')}}</span>
            </a>
          </li>
          <li class="">
            <a href="{{route('chart')}}">
            {{-- <a href="{{asset('')}}chart/0/"> --}}
              <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>{{__('text.chart')}}</span>
            </a>
          </li>
        </ul>
      </section>
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          {{__('text.table')}}
        </h1>
        <ol class="breadcrumb">
          <li><a><i class="fa fa-dashboard"></i> {{__('text.home')}}</a></li>
          <li><a>{{__('text.table')}}</a></li>
        </ol>
      </section>
      <section class="content">
        @yield('content')
      </section>
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      </div>
      <strong>{{__('text.copy')}} &copy; {{__('text.year')}}<a> {{__('text.skillmatrix')}}</a>.</strong> {{__('text.reserved')}}
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <script src="{{asset('../js/jquery.min.js')}}"></script>
  <script src="{{asset('../js/bootstrap.min.js')}}"></script>
  <script src="{{asset('../js/jquery.slimscroll.min.js')}}"></script>
  <script src="{{asset('../js/fastclick.js')}}"></script>
  <script src="{{asset('../js/adminlte.min.js')}}"></script>
  <script src="{{asset('../js/demo.js')}}"></script>
  <script src="{{asset('../js/toastr.min.js')}}"></script>
  @yield('foot')
</body>
</html>