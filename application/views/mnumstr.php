<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" onclick="formParent()"><i class="nav-icon fa fa-fw fa-plus"></i>
                    Parent</button>
                <button class="btn btn-primary" onclick="formChild()"><i class="nav-icon fa fa-fw fa-plus"></i>
                    Child</button>
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Menu Uri</th>
                            <th>Menu Parent</th>
                            <th>Icon</th>
                            <th>Urutan</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
            foreach ($menu as $key) { ?>
                        <tr>
                            <td><?= $key->mnu_id ?></td>
                            <td><?= $key->mnu_name ?></td>
                            <td><?= $key->mnu_uri ?></td>
                            <td><?= $key->mnu_parent ?></td>
                            <td><?= $key->mnu_icon ?></td>
                            <td><?= $key->mnu_sort ?></td>
                            <td><?= $key->mnu_status ?></td>
                            <td>
                                <button class="btn btn-info" onclick="editMenu(<?= $key->mnu_id ?>)"><i
                                        class="fa fa-fw fa-edit"></i></button>
                                <button class="btn btn-danger" onclick="deleteMenu(<?= $key->mnu_id ?>)"><i
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
<!-- /.content -->

<div class="modal fade" id="modal-addmenuparent">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Menu Parent</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmNewMnuPrn">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="mnuparn">Menu Parent
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="mnuparn" name="mnuparn" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="mnuuri">Menu Uri
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="mnuuri" name="mnuuri" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="mnuicon">Menu Icon
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="mnuicon" name="mnuicon" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="urutanparent">Urutan
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="number" id="urutanparent" name="urutanparent" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="stsparent" name="stsparent">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-addmenuchild">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Menu Child</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmNewMnuchild">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Parent</label>
                            <select class="form-control" id="prnchld" name="prnchld">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="mnuchld">Menu Child
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="mnuchld" name="mnuchld" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="mnuurichld">Menu Uri
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="mnuurichld" name="mnuurichld" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="urutanchild">Urutan
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="number" id="urutanchild" name="urutanchild" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="stschld" name="stschld">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" onclick="saveAddChild()">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="modal-editmenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmEditMnu">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="menu">Menu
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="hidden" id="id" name="id" class="form-control" />
                            <input type="text" id="menu" name="menu" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="menuuri">Menu Uri
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="menuuri" name="menuuri" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="menuicon">Menu Icon
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="text" id="menuicon" name="menuicon" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="urutan">Urutan
                                <span class="text-danger"> * </span>
                            </label>
                            <input type="number" id="urutan" name="urutan" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
$(document).ready(function() {
    $('#frmNewMnuPrn').validate({
        rules: {
            mnuparn: {
                required: true
            },
            mnuuri: {
                required: true
            },
            mnuicon: {
                required: true
            },
            urutanparent: {
                required: true
            }
        },
        messages: {
            mnuparn: {
                required: "Masukan Nama Menu",
            },
            mnuuri: {
                required: "Masukan Menu Uri"
            },
            mnuicon: {
                required: "Masukan Icon"
            },
            urutanparent: {
                required: "Masukan Urutan"
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
                url: '<?= base_url() ?>mnumstr/addParentMenu',
                data: {
                    mnuparn: $('#mnuparn').val(),
                    mnuuri: $('#mnuuri').val(),
                    mnuicon: $('#mnuicon').val(),
                    stsparent: $('#stsparent').val(),
                    urutan: $('#urutanparent').val()
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
    $('#frmNewMnuchild').validate({
        rules: {
            prnchld: {
                required: true
            },
            mnuchld: {
                required: true
            },
            mnuurichld: {
                required: true
            },
            urutanchild: {
                required: true
            }
        },
        messages: {
            prnchld: {
                required: "Pilih Parent Menu",
            },
            mnuchld: {
                required: "Masukan Nama Menu"
            },
            mnuurichld: {
                required: "Masukan Menu Uri"
            },
            urutanchild: {
                required: "Masukan Urutan"
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
                url: '<?= base_url() ?>mnumstr/addChildMenu',
                data: {
                    prnchld: $('#prnchld').val(),
                    mnuchld: $('#mnuchld').val(),
                    mnuurichld: $('#mnuurichld').val(),
                    stschld: $('#stschld').val(),
                    urutanchild: $('#urutanchild').val()
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        successtr(response.message)
                    } else {
                        errortr(response.message)
                    }
                },
                error: function() {
                    // error()
                }
            });
        }
    });
    $('#frmEditMnu').validate({
        rules: {
            menu: {
                required: true
            },
            menuuri: {
                required: true
            },
            urutan: {
                required: true
            }
        },
        messages: {
            menu: {
                required: "Masukan Nama Menu",
            },
            menuuri: {
                required: "Masukan Uri Menu"
            },
            urutan: {
                required: "Masukan Urutan"
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
                url: '<?= base_url() ?>mnumstr/saveEditMenu',
                data: {
                    id: $('#id').val(),
                    menu: $('#menu').val(),
                    menuuri: $('#menuuri').val(),
                    menuicon: $('#menuicon').val(),
                    urutan: $('#urutan').val(),
                    status: $('#status').val()
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

$("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
});

function formParent() {
    $('#mnuparn').val('')
    $('#mnuuri').val('')
    $('#mnuicon').val('')
    $('#modal-addmenuparent').modal()
}

function formChild() {
    $('#mnuchld').val('')
    $('#mnuurichld').val('')
    $('#mnuiconchld').val('')
    $('#modal-addmenuchild').modal()
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>mnumstr/getMnuParent',
        success: function(data) {
            var html = '';
            var i;
            html += '<option value="">-- Pilih Parent --</option>';
            for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].mnu_id + '>' + data[i].mnu_name + '</option>';
            }
            $('#prnchld').html(html);
        },
        error: function() {
            error()
        }
    });
}

function editMenu(id) {
    // console.log(id)
    $('#menu').val('')
    $('#id').val('')
    $('#menuuri').val('')
    $('#menuicon').val('')
    $('#urutan').val('')
    $('#modal-editmenu').modal()
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>mnumstr/getEditMenu',
        data: {
            id: id
        },
        success: function(response) {
            // console.log(response.mnu_childyn)
            $('#id').val(response.mnu_id)
            $('#menu').val(response.mnu_name)
            $('#menuuri').val(response.mnu_uri)
            $('#menuicon').val(response.mnu_icon)
            $('#urutan').val(response.mnu_sort)
        },
        error: function() {
            error()
        }
    });
}

function deleteMenu(id) {
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
                url: '<?= base_url() ?>mnumstr/deleteMenu',
                data: {
                    id: id
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
    })
}
</script>