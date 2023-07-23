<?php
include_once "config/db.koneksi_pdo.php";
include_once "config/db.function_pdo.php";
include_once "config/library.php";
cekUser($DBcon);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">
    <title>Akuntansi MDA - Dashboard</title>
    <link rel="shortcut icon" sizes="363x492" href="assets/img/logo.png" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/css/ol.css" type="text/css">
    <script src="assets/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.5.0/build/ol.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <link href="vendor/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen" /> -->
    <!-- <script src="vendor/bootstrap-select2/select2.min.js" type="text/javascript"></script> -->

    <!-- datepicker -->
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
    <link href="assets/css/datepicker.css" rel="stylesheet">
    <script src="assets/js/datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/ol-street-view@2.0.0/dist/css/ol-street-view.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    <script src="https://unpkg.com/ol-street-view@2.0.0"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://unpkg.com/ol-pdf-printer@1.0.21/dist/css/ol-pdf-printer.css" />
    <link rel="stylesheet" href="https://unpkg.com/ol-pdf-printer@1.0.21/dist/css/bootstrap.min.css" /> <!-- Bootstrap bundle -->
    <script src="https://unpkg.com/ol-pdf-printer@1.0.21"></script>

    <script>
        $(document).ready(function() {
            $(".preloader").fadeOut();
            $('.date').datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: 'TRUE',
                autoclose: true,
            });
        });

        toastr.options = {

            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <style>
        .tooltip {
            position: relative;
            padding: 3px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            opacity: 0.7;
            white-space: nowrap;
            font: 10pt sans-serif;
        }

        .map {
            height: 400px;
            width: 100%;
        }

        .btn-map {
            padding: 6px 10px;
            background: #FF9AA2;
            color: #ffffff;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btn-map-selected {
            padding: 6px 10px;
            background: #ffffff;
            color: #FF9AA2;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btn-map:hover {
            padding: 6px 10px;
            background: #D58187;
            color: #ffffff;
            border-radius: 2px;
            opacity: 0.9;
        }

        .btnedit {
            box-shadow: 0px 1px 0px 0px #fff6af;
            background: linear-gradient(to bottom, #ffec64 5%, #ffab23 100%);
            background-color: #ffec64;
            border-radius: 4px;
            border: 1px solid #ffaa22;
            display: inline-block;
            color: #333333;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 6px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffee66;
        }

        .btnedit:hover {
            background: linear-gradient(to bottom, #ffab23 5%, #ffec64 100%);
            background-color: #ffab23;
        }

        .btndel {
            box-shadow: inset 0px 1px 0px 0px #fff6af;
            background: linear-gradient(to bottom, #ffc766 5%, #ff2424 100%);
            background-color: #ffc766;
            border-radius: 4px;
            border: 1px solid #ff2424;
            display: inline-block;
            cursor: pointer;
            color: #333333;
            font-family: Arial;
            font-size: 12px;
            font-weight: bold;
            padding: 4px 6px;
            text-decoration: none;
            text-shadow: 0px 1px 0px #ffba66;
        }

        .btndel:hover {
            background: linear-gradient(to bottom, #ff2424 5%, #ffc766 100%);
            background-color: #ff2424;
        }
    </style>
</head>

<body id="page-top">
    <div class="preloader">
        <div class="loading">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <img src="assets/img/logo.png" style="max-width:35px;">
                </div>
                <div class="sidebar-brand-text mx-3">ADMINISTRASI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Menu
            </div> -->


            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="?modul=dashboard">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a class="nav-link collapsed" href="?modul=daftar_rekening">
                    <i class="fas fa-map"></i>
                    <span>Daftar Rekening</span>
                </a>
                <a class="nav-link collapsed" href="?modul=entri_pendataan">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Entri Pendataan</span>
                </a>
                <a class="nav-link collapsed" href="?modul=daftar_pendataan">
                    <i class="fas fa-map"></i>
                    <span>Daftar Pendataan</span>
                </a>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?modul=laporan_jurnal">Laporan Jurnal</a>
                        <a class="collapse-item" href="?modul=buku_besar">Buku Besar</a>
                        <a class="collapse-item" href="?modul=neraca_saldo">Neraca Saldo</a>
                    </div>
                </div>
                <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Peta</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?modul=import">Import Geojson</a>
                        <a class="collapse-item" href="?modul=import_bpn">Import Geojson BPN</a>
                        <a class="collapse-item" href="?modul=update_kecamatan">Update Peta Kecamatan</a>
                        <a class="collapse-item" href="?modul=update_kelurahan">Update Peta Kelurahan</a>
                        <a class="collapse-item" href="?modul=update_blok">Update Peta Blok</a>
                        <a class="collapse-item" href="?modul=update_nop">Data Peta Bidang</a>
                        <a class="collapse-item" href="?modul=gen_peta_njop">Generate Peta NJOP</a>
                        <a class="collapse-item" href="?modul=objek_baru">Peta Objek Paru</a>
                    </div>
                </div> -->
                <!-- <a class="nav-link collapsed" href="?modul=petataatpbb">
                    <i class="fas fa-map"></i>
                    <span>Peta Ketaatan PBB</span>
                </a>
                <a class="nav-link collapsed" href="?modul=petazonanjop">
                    <i class="fas fa-map"></i>
                    <span>Peta Zona NJOP</span>
                </a>
                <a class="nav-link collapsed" href="?modul=petaznjoppernop">
                    <i class="fas fa-map"></i>
                    <span>Peta Zona NJOP per NOP</span>
                </a>
                <a class="nav-link collapsed" href="?modul=petareklame">
                    <i class="fas fa-map"></i>
                    <span>Peta Reklame</span>
                </a>
                <a class="nav-link collapsed" href="?modul=bphtb">
                    <i class="fas fa-map"></i>
                    <span>Peta BPHTB</span>
                </a>

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePetaZNT" aria-expanded="true" aria-controls="collapsePetaZNT">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Peta Zona Nilai Tanah</span>
                </a>
                <div id="collapsePetaZNT" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?modul=petazntkota">Peta ZNT Kota</a>
                        <a class="collapse-item" href="?modul=petazntsismiop">Peta ZNT SISMIOP</a>
                        <a class="collapse-item" href="?modul=petazonanilaitanah">Pembentukan Peta ZNT</a>
                        <a class="collapse-item" href="?modul=petaznt">Pembentukan Peta ZNT Baru</a>
                    </div>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKodeZNT" aria-expanded="true" aria-controls="collapseKodeZNT">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Daftar Kode ZNT</span>
                </a>
                <div id="collapseKodeZNT" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?modul=daf_kodeznt">Perubahan Kode ZNT</a>
                        <a class="collapse-item" href="?modul=daf_petaznt">Pembentukan Peta ZNT</a>
                    </div>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLog" aria-expanded="true" aria-controls="collapseLog">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Daftar Log</span>
                </a>
                <div id="collapseLog" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?modul=daf_log_kodeznt">Log Perubahan Kode ZNT</a>
                        <a class="collapse-item" href="?modul=daf_log_petaznt">Log Pembentukan Peta ZNT</a>
                        <a class="collapse-item" href="?modul=daf_log_perubahan_peta_znt">Log Perubahan Peta ZNT</a>
                    </div>
                </div> -->
            </li>
            <?php
            if ($_SESSION['peran'] == md5(100)) {
            ?>
                <hr class="sidebar-divider my-0">
                <!-- Master -->
                <div class="sidebar-heading">
                    Master
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="?modul=users">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
            <?php
            }
            ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

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

                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <?php
                            include "breadcrumbs.php";
                            ?>
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" align="right" style="font-size: 11px;"><b style="font-size: 13px;"><?php echo $_SESSION["namauser"]; ?></b> <br> <?php echo $_SESSION["namaperan"]; ?></span>
                                <img class="img-profile rounded-circle" src="assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <?php include "content.php"; ?>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LOGOUT</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah anda yakin akan keluar ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/js/jquery.md5.min.js" type="text/javascript"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script> -->

    <!-- DataTable -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="assets/js/bootstrap-filestyle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

</body>

</html>