<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Caleg">
    <meta name="author" content="Alwan, Iqro, Ibnu">

    <title>{{ $title ?? 'Laravel' }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    {{-- anychart js --}}
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-cartesian-3d.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    <style>
        #chart {
            width: 100%;
            height: 500px;
            margin: 0;
            padding: 0;
        }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background: {{ auth("web")->check() ? auth()->user()->warna : auth("caleg")->user()->partai->warna }};" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ asset('/') }}">
                <div class="sidebar-brand-icon">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                    <img src="{{ asset('images/jagat.png') }}" alt="" srcset="" width="50">
                </div>
                <div class="sidebar-brand-text mx-3">{{ auth()->guard("web")->check() ? "PT.Jagat" : auth()->guard("caleg")->user()->partai->nama_partai }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            @auth("web")
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaleg" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-tie"></i>
                    <span>Caleg</span>
                </a>
                <div id="collapseCaleg" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset("caleg") }}">
                            <i class="fas fa-user-tie"></i>
                            <span>Caleg</span>
                        </a>
                    </div>
                </div>
            </li>
            @endauth
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @auth("web")
                            <a class="collapse-item font-weight-bold" href="{{ asset("dashboard/legislatif") }}">
                                <i class="fas fa-gavel"></i>
                                <span>Legislatif</span>
                            </a>
                            <a class="collapse-item font-weight-bold" href="{{ asset("dashboard/partai") }}">
                                <i class="fas fa-university"></i>
                                <span>Partai</span>
                            </a>
                        @endauth
                        <a class="collapse-item font-weight-bold" href="{{ asset("dashboard/medsos") }}"><i class="fas fa-hashtag"></i>
                        <span>Medsos</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="far fa-folder"></i>
                    <span>Info Politik</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('infoPolitik/daftarIsu') }}">
                            <i class="fas fa-book-open"></i>
                            <span>Daftar Isu</span>
                        </a>
                        {{-- <a class="collapse-item font-weight-bold" href="{{ asset('infoPolitik/rekapitulasi') }}">
                            <i class="fas fa-house-user"></i>
                            <span>Rekapitulasi</span>
                        </a> --}}
                        <a class="collapse-item font-weight-bold" href="{{ asset('infoPolitik/berita') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>Berita</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <i class="fas fa-file-import"></i>
                    <span>Rekap Data</span>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('relawan') }}">
                            <i class="fas fa-hands-helping"></i>
                            <span>Relawan</span>
                        </a>
                        <a class="collapse-item font-weight-bold" href="{{ asset('program') }}">
                            <i class="fas fa-tasks"></i>
                            <span>Program</span>
                        </a>
                        <a class="collapse-item font-weight-bold" href="{{ asset('dpt') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>DPT</span>
                        </a>
                        <a class="collapse-item font-weight-bold" href="{{ asset('agenda') }}">
                            <i class="fas fa-calendar"></i>
                            <span>Agenda</span>
                        </a>
                        {{-- <a class="collapse-item font-weight-bold" href="">
                            <i class="fas fa-vote-yea"></i>
                            <span>Tabulasi Suara</span>
                        </a> --}}
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                    <i class="fas fa-chart-pie"></i>
                    <span>Survey</span>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('survey/inputSurvey') }}">
                            <i class="fas fa-plus-square"></i>
                            <span>Input Data</span>
                        </a>
                        <a class="collapse-item font-weight-bold" href="{{ asset('survey/HasilSurvey') }}">
                            <i class="fas fa-poll"></i>
                            <span>Variable Survey</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                    <i class="fas fa-laptop"></i>
                    <span>Data Saksi</span>
                </a>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('saksi/daftar') }}">
                            <i class="fas fa-list-ul"></i>
                            <span>Daftar Saksi</span>
                        </a>
                        <a class="collapse-item font-weight-bold" href="{{ asset('saksi/monitoring?table=desa') }}">
                            <i class="fas fa-desktop"></i>
                            <span>Monitoring</span>
                        </a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                    <i class="fas fa-user-friends"></i>
                    <span>Team Relawan</span>
                </a>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('team') }}">
                            <i class="fas fa-handshake"></i>
                            <span>Daftar Relawan</span>
                        </a>
                    </div>
                </div>
            </li>
{{--
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven1" aria-expanded="true" aria-controls="collapseSeven1">
                    <i class="fas fa-user-friends"></i>
                    <span>Perolehan Suara</span>
                </a>
                <div id="collapseSeven1" class="collapse" aria-labelledby="headingSeven1" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="{{ asset('') }}">
                        </a>
                    </div>
                </div>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                    <i class="far fa-star"></i>
                    <span>Promotion</span>
                </a>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item font-weight-bold" href="/whatsapp"><i class="fas fa-comments"></i>Wa Blas</a>
                        <a class="collapse-item font-weight-bold" href="/email"><i class="fas fa-envelope"></i>Email Blas</a>
                        <a class="collapse-item font-weight-bold" href=""><i class="fas fa-mobile"></i>Info Mobile</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ asset('documentation') }}">
                    <i class="fas fa-book"></i>
                    <span>Documentation</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Labels
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('backup') }}">
                    <i class="far fa-save"></i>
                    <span>Backup</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h3>{{ $title ?? 'Laravel' }}</h3>
                    <!-- Topbar Search -->
                    {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> --}}

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_lengkap ?? auth()->guard("caleg")->user()->nama_lengkap}}</span>
                                <img class="img-profile rounded-circle" src="{{ Auth::guard("web")->check() ? asset("images/" . Auth::user()->foto_user) : asset(Auth::guard("caleg")->user()->foto) }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" onclick="return confirm('Anda yaking ingin logout ?')" href="{{ asset('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sign out
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                {{-- Session Modal --}}
                @if (session()->has('success'))
                    <div class="col-md-12 text-center">
                        <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="col-md-6 text-center">
                        <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Begin Page Content -->
                <div>
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Jagat Digital 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- javascripy bootstarp -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>

</html>
