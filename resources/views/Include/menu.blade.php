<!-- Page Sidebar -->
<div class="page-sidebar">
    <a class="logo-box" href="/">
        <span><img src="{{asset('assets/images/logo.png')}}" width="150px" height="150px"/></span>
        <div class="row">
            <div class="col-sm-12"><span style="font-size:18px"><center>SD Islam</center></span></div>
            <div class="col-sm-12"><span style="font-size:18px"><center>Dian Didaktika</center></span></div>
        </div>
        {{-- <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i> --}}
        <i class="icon-close" id="sidebar-toggle-button-close"></i>
    </a>
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="active-page">
                    <a href="/">
                        <i class="menu-icon fa fa-home"></i><span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon icon-flash_on"></i><span>Master</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="/guru">Guru</a></li>
                        <li><a href="/kriteria">Kriteria</a></li>
                        <li><a href="/sub">Sub Kriteria</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon icon-layers"></i><span>Transaksi</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="/perhitungan">Perhitungan</a></li>
                        <li><a href="/keputusan">Keputusan Guru Terbaik</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon icon-code"></i><span>Laporan</span><i class="accordion-icon fa fa-angle-left"></i>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="/laporanguru">Guru Terbaik</a></li>
                        <li><a href="/laporanranking">Ranking Guru</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div><!-- /Page Sidebar -->

<!-- Page Content -->
<div class="page-content">
<!-- Page Header -->
<div class="page-header">
    <div class="search-form">
        <form action="#" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control search-input" placeholder="Type something...">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="close-search" type="button"><i class="icon-close"></i></button>
                </span>
            </div>
        </form>
    </div>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="logo-sm">
                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                    <a class="logo-box" href="index.html"><span>ecaps</span></a>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <i class="fa fa-angle-down"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="http://via.placeholder.com/36x36" alt="" class="img-circle"></a>
                        <ul class="dropdown-menu">
                            <div class="dropdown-menu dropdown-menu-right with-arrow">
                                <!-- User dropdown menu -->
                                <ul class="head-list">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
<!-- /Page Header -->

<!-- Page Inner -->
<div class="page-inner">
