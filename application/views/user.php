<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="formUser()"><i class="nav-icon fa fa-fw fa-plus"></i>
                    Tambah</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($user as $key) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $key->username ?></td>
                            <td><?= $key->nama ?></td>
                            <td><?= $key->role ?></td>
                            <td><?php if ($key->status == 'A') {
                                        echo '<span class="badge badge-info" >Aktif</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Inactive</span>';
                                    } ?>
                            </td>
                            <td>
                                <button class="btn btn-info" onclick="formEdit('<?= $key->username ?>')"><i
                                        class="fa fa-fw fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="deleteUser(<?= $key->id ?>)"><i
                                        class="fa fa-fw fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
</div>
<!-- /.row -->
<!-- /.content -->

<div class="modal fade" id="modal-adduser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmNewUser">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Username</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="username" name="username" class="form-control"
                                placeholder="Masukan Username">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <span class="text-danger"> * </span>
                            <select class="form-control select2" id="role" name="role">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <span class="text-danger"> * </span>
                            <select class="form-control" id="status" name="status">
                                <option value="A">Aktif</option>
                                <option value="I">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-edituser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmEditUser">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Username</label>
                            <span class="text-danger"> * </span>
                            <input type="hidden" id="id" name="id" class="form-control" placeholder="Masukan Username">
                            <input type="text" id="username2" name="username2" class="form-control"
                                placeholder="Masukan Username" readonly>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="nama2" name="nama2" class="form-control" placeholder="Masukan Nama">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <span class="text-danger"> * </span>
                            <select class="form-control select2" id="role2" name="role2">
                                <input type="hidden" id="roleold" name="roleold" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <span class="text-danger"> * </span>
                            <select class="form-control" id="status2" name="status2">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
</div>

<script>
$('.select2').select2()

$("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
})

function formEdit(username) {
    $('#id').val('')
    $('#username2').val('')
    $('#nama2').val('')
    $('#role2').val('')
    $('#roleold').val('')
    $('#modal-edituser').modal()
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>user/getUser',
        data: {
            username: username
        },
        success: function(data) {
            $('#id').val(data.id)
            $('#username2').val(data.username)
            $('#roleold').val(data.role)
            $('#nama2').val(data.nama)
            var html = ''
            if (data.status == 'A') {
                html += '<option value="A" Selected>Aktif</option>'
                html += '<option value="I">Inactive</option>'
            } else if (data.status == 'I') {
                html += '<option value="A">Aktif</option>'
                html += '<option value="I" Selected>Inactive</option>'
            } else {
                html += '<option value="A">Aktif</option>'
                html += '<option value="I">Inactive</option>'
            }
            $('#status2').html(html)
            role()
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan.',
                showConfirmButton: false,
                timer: 1500
            })
            reload()
        }
    });
}

function role() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>user/getRole',
        success: function(data) {
            var html = '';
            html += '<option value="">-- Pilih Role --</option>';
            for (var i = 0; i < data.length; i++) {
                if (data[i].rol_code === $('#roleold').val()) {
                    html += '<option value=' + data[i].rol_code + ' selected>' + data[i].rol_name +
                        '</option>';
                } else {
                    html += '<option value=' + data[i].rol_code + '>' + data[i].rol_name + '</option>';
                }
            }
            $('#role2').html(html);
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan.',
                showConfirmButton: false,
                timer: 1500
            })
            reload()
        }
    });
}

function formUser() {
    $('#username').val('')
    $('#role').val('')
    $('#modal-adduser').modal()
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>user/getRole',
        success: function(data) {
            var html = '';
            html += '<option value="">-- Pilih Role --</option>';
            for (var i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].rol_code + '>' + data[i].rol_name + '</option>';
            }
            $('#role').html(html);
        },
        error: function() {
            error()
        }
    });
}

$(document).ready(function() {
    $('#frmNewUser').validate({
        rules: {
            username: {
                required: true,
                minlength: 5
            },
            role: {
                required: true
            },
            nama: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Masukan Username",
                minlength: "Username minimal 5 karakter"
            },
            role: {
                required: "Pilih Role"
            },
            nama: {
                required: "Masukan Nama"
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
        },

        submitHandler: function() {
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>user/addUser',
                data: {
                    username: $('#username').val(),
                    nama: $('#nama').val(),
                    role: $('#role').val(),
                    status: $('#status').val()
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        successtr(response.message)
                    } else if (response.result == 'Invalid') {
                        errortr(response.message)
                    } else {
                        errortr(response.message)
                    }
                },
                error: function() {
                    error()
                }
            });
        }
    });
    $('#frmEditUser').validate({
        rules: {
            username2: {
                required: true
            },
            nama2: {
                required: true
            },
            role2: {
                required: true
            }
        },
        messages: {
            username2: {
                required: "Masukan Username",
            },
            nama2: {
                required: "Masukan Nama"
            },
            role2: {
                required: "Pilih role"
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
        },

        submitHandler: function() {
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>user/editUser',
                data: {
                    id: $('#id').val(),
                    nama: $('#nama2').val(),
                    role: $('#role2').val(),
                    status: $('#status2').val()
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        successtr(response.message)
                    } else {
                        errortr(response.message)
                    }
                },
                error: function() {
                    error()
                }
            });
        }
    });
});

function deleteUser(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Anda tidak bisa mengembalikannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>user/deleteUser',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        successtr(response.message)
                    } else {
                        erortr(response.message)
                    }
                },
                error: function() {
                    error()
                }
            });
        }
    })
}
</script>