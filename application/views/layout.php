<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STOCK OPNAME</title>


    <!-- <script type="text/javascript" src="<?= base_url() ?>instascan.min.js"></script> -->

    <link rel="icon" href="<?= base_url() ?>img/favicon.png">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- pace-progress -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/pace-progress/themes/black/pace-theme-flat-top.css">

    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="<?= base_url('assets') ?>/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <style type="text/css">
    #loading {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: center no-repeat #fff;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .no-js #loader {
        display: none;
    }

    .js #loader {
        display: block;
        position: absolute;
        left: 100px;
        top: 0;
    }

    .loader {
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #1644db;
        border-bottom: 10px solid #9da7a8;
        width: 150px;
        height: 150px;
        left: 43.5%;
        top: 20%;
        -webkit-animation: spin 2s linear infinite;
        position: fixed;
        animation: spin 2s linear infinite;
    }

    .textLoader {
        position: fixed;
        top: 56%;
        left: 45.6%;
        color: #34495e;
    }

    /*-- responsive --*/
    @media screen and (max-width: 1034px) {
        .textLoader {
            left: 46.2%;
        }
    }

    @media screen and (max-width: 824px) {
        .textLoader {
            left: 47.2%;
        }
    }

    @media screen and (max-width: 732px) {
        .textLoader {
            left: 48.2%;
        }
    }

    @media screen and (max-width: 500px) {
        .loader {
            left: 36.5%;
            ;
        }

        .textLoader {
            left: 40.5%;
        }
    }

    @media screen and (max-height: 432px) {
        .textLoader {
            top: 65%;
        }
    }

    @media screen and (max-height: 350px) {
        .textLoader {
            top: 75%;
        }
    }

    @media screen and (max-height: 312px) {
        .textLoader {
            display: none;
        }
    }
    </style>

    <!-- <script type="text/javascript">
      $("#loading").hide();
      $(".loader").hide();
    </script> -->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm pace-primary">
    <!-- <div id="loading">
      <div class="logoLoader"></div>
      <span class="loader"></span>
      <div class="textLoader">
        <center>
        <b>Please Wait ... </b>
        </center>
      </div>
    </div> -->
    <div class="wrapper">
        <?php
        is_logged_in();

        //header
        $this->load->view('layout_component/header.php');
        //sidebar
        $this->load->view('layout_component/sidebar.php');
        ?>

        <!-- jQuery -->
        <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
        <!-- jquery-validation -->
        <script src="<?= base_url('assets') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/jquery-validation/additional-methods.min.js"></script>

        <!-- DataTables -->
        <script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- Select2 -->
        <script src="<?= base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
        <!-- Toastr -->
        <script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
        <!-- SweetAlert2 -->
        <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Bootstrap4 Duallistbox -->
        <script src="<?= base_url('assets') ?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js">
        </script>
        <!-- InputMask -->
        <script src="<?= base_url('assets') ?>/plugins/moment/moment.min.js"></script>
        <script src="<?= base_url('assets') ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- date-range-picker -->
        <script src="<?= base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?= base_url('assets') ?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="<?= base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
        <script src="<?= base_url('assets') ?>/jquery-loading-overlay-2.1.6/dist/loadingoverlay.min.js"
            type="text/javascript"></script>

        <!-- Select2 -->
        <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/select2/css/select2.min.css">
        <link rel="stylesheet"
            href="<?= base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- content-wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $pagetitle ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <?php if (!$submenuname) { ?>
                                <li class="breadcrumb-item active"><?= $menuname ?></li>
                                <?php } else { ?>
                                <li class="breadcrumb-item"><?= $menuname ?></li>
                                <li class="breadcrumb-item active"><?= $submenuname ?></li>
                                <?php } ?>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <?php
                    //content
                    $this->load->view($page);
                    ?>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>2022-<?= date("Y"); ?> &copy; Stock Opname</strong>
            By Dzulrachman.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>
    </div>
</body>

</html>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets') ?>/dist/js/adminlte.js"></script>
<!-- pace-progress -->
<script src="<?= base_url('assets') ?>/plugins/pace-progress/pace.min.js"></script>
<script>
//Initialize Select2 Elements
// $('.select2').select2()

//Initialize Select2 Elements
// $('.select2bs4').select2({
//   theme: 'bootstrap4'
// })
function logout() {
    Swal.fire({
        title: 'Anda ingin logout?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            Swal.fire({
                icon: 'success',
                title: 'Logout Berhasil',
                showConfirmButton: false,
                timer: 1500
            })
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>login/logout'
            });
            reload()
        }
    })
}

function reload() {
    setTimeout(function() {
        window.location.reload();
    }, 1000);
}

function successtr(message) {
    Swal.fire({
        icon: 'success',
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
    reload()
}

function errortr(message) {
    Swal.fire({
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 1500
    })
}

function error() {
    Swal.fire({
        icon: 'error',
        title: 'Terjadi kesalahan.',
        showConfirmButton: false,
        timer: 1500
    })
    reload()
}

window.onload = function() {
    jam();
}

function jam() {
    var e = document.getElementById('jam'),
        d = new Date(),
        h, m, s;
    h = d.getHours();
    m = set(d.getMinutes());
    s = set(d.getSeconds());

    e.innerHTML = h + ':' + m + ':' + s;

    setTimeout('jam()', 1000);
}

function set(e) {
    e = e < 10 ? '0' + e : e;
    return e;
}
</script>