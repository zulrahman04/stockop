<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stok OP</title>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/adminlte.min.css?v=3.2.0">
    <!-- pace-progress -->
    <!-- <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/pace-progress/themes/black/pace-theme-flat-top.css"> -->
</head>

<body>
    <div class="wrapper">
        <section class="content">
            <br><br><br><br><br><br><br><br>
            <div class="col-12" style="display: flex; justify-content: center;">
                <div class="card card-primary" style="width: 25rem;">
                    <div class="card-header" style="display: flex; justify-content: center;">
                        <a href="<?= base_url() ?>">
                            <h1 align="center" class="form-signin-heading"><img src="HRIS.png" height="65" width="155">
                            </h1>
                        </a>
                    </div>
                    <form action="#" method="post" id="formlogin">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" id="username" name="username" class="form-control"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Password">
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">LOGIN</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>


    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>

    <script src="<?= base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js?v=3.2.0"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- jquery-validation -->
    <script src="<?= base_url('assets') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url('assets') ?>/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- pace-progress -->
    <!-- <script src="<?= base_url('assets') ?>/plugins/pace-progress/pace.min.js"></script> -->
</body>

</html>

<script type="text/javascript">
$(document).ready(function() {
    $.validator.setDefaults({
        submitHandler: function() {
            $.ajax({
                dataType: "json",
                type: "POST",
                data: {
                    username: $('#username').val(),
                    password: $('#password').val()
                },
                success: function(response) {
                    if (response.result == 'Login Berhasil') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Berhasil',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        reload()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Username/Password salah atau Akun anda Non Aktif.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // reload()
                }
            });
        }
    });

    function reload() {
        setTimeout(function() {
            window.location.reload();
        }, 1000);
    }
    $('#formlogin').validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            username: {
                required: "Please enter a username"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>