<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Monitoring dan Evaluasi Ditjen PPA Kementrian LHK Republik Indonesia">
    <meta name="author" content="adhi@mbuh.ltd">
    <meta name="generator" content="phpstorm">
    <title>{{ config('app.name') }}@if ($__env->yieldContent('title')) - @yield('title')@endif</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/internal.bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="/assets/css/styles.min.css">
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">

@if (View::hasSection('links'))
@yield('links')
@endif

@if (View::hasSection('in-style'))
    <style>
@yield('in-style')
    </style>
@endif
</head>

<body id="page-top">

    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top" style="min-height: 100px;">
                    <div class="container-fluid">
                        <div align="center">
                            <h6 align="left" style="color: black;">
                                <img src="/assets/img/logo-lhk.png" style="width: 69px;margin-right: 15px;">
                                KEMENTRIAN LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA
                            </h6>
                        </div>
                        <!-- <form action="/search" method="post" class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            @CSRF
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Mencari permohonan di sini ..." name="keyword" required>
                                <div class="input-group-append"><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button></div>
                            </div>
                        </form> -->
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Mencari permohonan di sini X...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#"><span style="color: black;">MENU</span><i class="fab fa-windows fa-fw" style="color: rgb(0,128,0); margin-left: 10px;"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                     role="menu">
                                    <h6 class="dropdown-header">Menu</h6>
@if ($USER['POSISI']=='DIR')
                                    <a class="d-flex align-items-center dropdown-item" href="/dashboard">
                                        <div class="dropdown-list-image mr-3"><i class="fa fa-bar-chart-o" style="font-size: 36px;color: rgba(0,23,255,0.25);"></i></div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>Dashboard</span></div>
                                            <p class="small text-gray-500 mb-0">Ringkasan Proses Permohonan</p>
                                        </div>
                                    </a>
@endif
                                    <a class="d-flex align-items-center dropdown-item" href="/home">
                                        <div class="dropdown-list-image mr-3"><i class="fas fa-inbox" style="color: rgba(0,23,255,0.25);font-size: 36px;"></i></div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>Inbox</span></div>
                                            <p class="small text-gray-500 mb-0">Daftar Permohonan</p>
                                        </div>
                                    </a>
@if ($USER['POSISI']=='KSD')
                                    <a class="d-flex align-items-center dropdown-item" href="/manage/user">
                                        <div class="dropdown-list-image mr-3"><i class="fas fa-user-cog" style="color: rgba(0,23,255,0.25);font-size: 36px;"></i></div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate"><span>User Management</span></div>
                                            <p class="small text-gray-500 mb-0">Pengelolaan Pengguna</p>
                                        </div>
                                    </a>
@endif
                                </div>
                            </li>
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown"></div>
                            </li>

                            <div class="d-none d-sm-block topbar-divider"></div>

                            <li class="nav-item dropdown no-arrow" role="presentation">
                            <li class="nav-item dropdown no-arrow">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <img class="nav-user-photo" src="/assets/img/avatar2.png" alt="" style="margin-right: 10px" /> 
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small">{{ $USER['NAMA'] }} </span>
                                    <i style='font-size:24px' class='fas'>&#xf107;</i>
                                </a>
                                <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
                                    <a class="dropdown-item" role="presentation" href="/account/settings"><i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" role="presentation" href="/account/logout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout
                                    </a>
                                </div>
                            </li>
                            </li>

                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4"></div>
@yield('content')
                </div>
            </div>
            <footer class="bg-white sticky-footer" style="padding: 5px 0px;">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span style="font-size: 11px;">© 2019 Direktorat Pengendalian Pencemaran Air</span></div>
                </div>
            </footer>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.easing.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
@if (View::hasSection('scripts'))
@yield('scripts')
@endif

@if (View::hasSection('in-script'))
    <script>
@yield('in-script')
    </script>
@endif
</body>

</html>
