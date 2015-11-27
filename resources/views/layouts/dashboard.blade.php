@extends('layouts.plane')

@section('body')
 <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">Reporting</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
               <li class="dropdown">
                    <a href="{{ url ('/') }}"><i class="fa fa-folder fa-fw"></i>  Home <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <!-- /.dropdown-alerts -->
                </li>

                <li class="dropdown">
                    <a href="{{ url ('home') }}"><i class="fa fa-folder fa-fw"></i>  Reporting <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <!-- /.dropdown-alerts -->
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url ('/') }}"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url ('/auth/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      
                        
                        <li >
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> PWS KIA Reproting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                     <a href="#"><i class="fa fa-files-o fa-fw"></i> PWS IBU<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">   
                                        <li {{ (Request::is('*kia') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('kia') }}">PWS IBU 1</a>
                                        </li>
                                        <li {{ (Request::is('*kiaibu') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('kiaibu') }}">PWS IBU 2</a>
                                        </li>
                                        <li {{ (Request::is('*kiaibu3') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('kiaibu3') }}">PWS IBU 3</a>
                                        </li>
                                        <li {{ (Request::is('*kiaibu4') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('kiaibu4') }}">PWS IBU 4</a>
                                        </li>
                                        <li {{ (Request::is('*kiaibu5') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('kiaibu5') }}">PWS IBU 5</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                     <a href="#"><i class="fa fa-files-o fa-fw"></i> PWS ANAK<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">   
                                
                                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('#' ) }}">PWS ANAK 1</a>
                                        </li>
                                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('#' ) }}">PWS ANAK 2</a>
                                        </li>
                                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('#' ) }}">PWS ANAK 3</a>
                                        </li>
                                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('#' ) }}">PWS ANAK 4</a>
                                        </li>
                                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                            <a href="{{ url ('#' ) }}">PWS ANAK 5</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                                    <a href="{{ url('#') }}"><i class="fa fa-file-word-o fa-fw"></i> AMP</a>
                                </li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                            <a href="{{ url ('#') }}"><i class="fa fa-file-word-o fa-fw"></i> Lap Kasus&Kematian Maternal</a>
                        </li>
                        <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                            <a href="{{ url ('#') }}"><i class="fa fa-file-word-o fa-fw"></i> Lap Kes balita</a>
                        </li>
                         <li {{ (Request::is('#') ? 'class="active"' : '') }}>
                            <a href="{{ url ('#') }}"><i class="fa fa-file-word-o fa-fw"></i> Lap Kasus&Kematian Maternal</a>
                        </li>
                        <li {{ (Request::is('*#') ? 'class="active"' : '') }}>
                            <a href="{{ url ('#') }}"><i class="fa fa-file-word-o fa-fw"></i> Lap Kes balita</a>
                        </li>
                   
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
             <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
           </div>
            <div class="row">  
                @yield('section')

            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop

