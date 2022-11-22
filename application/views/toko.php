<div class="card">
    <div class="card-header">
        <button class="btn btn-primary" onclick="formToko()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped" id="mydata">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Toko</th>
                    <th>Alamat </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($toko as $key) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $key->nama ?></td>
                    <td><?= $key->alamat ?></td>
                    <td><a href="#" class="btn btn-primary" onclick="formEditToko(<?= $key->id ?>)"><i
                                class="fa fa-fw fa-edit"></i></a>
                        <a href="#" class="btn btn-danger" onclick="hapus(<?= $key->id ?>)"><i
                                class="fa fa-fw fa-trash"></i></a>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div> -->
    <!-- /.card-footer -->
</div>

<div class="modal fade" id="modal-addtoko">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmtoko">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Toko</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="toko" name="toko" class="form-control" placeholder="Masukan Toko">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control"
                                placeholder="Masukan Alamat">
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

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmedit">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Toko</label>
                            <span class="text-danger"> * </span>
                            <input type="hidden" id="id" name="id">
                            <input type="text" id="toko2" name="toko2" class="form-control" placeholder="Masukan Toko">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" id="alamat2" name="alamat2" class="form-control"
                                placeholder="Masukan Alamat">
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
<!-- /.card -->
<!-- /.content -->

<script>
$(document).ready(function() {

    table = $('#mydata').DataTable({
        "processing": true
    });
});

function formToko() {
    $('#toko').val('')
    $('#alamat').val('')
    $('#modal-addtoko').modal()
}


function formEditToko(id) {
    $('#toko2').val('')
    $('#alamat2').val('')
    $('#id').val('')
    $('#modal-edit').modal()

    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Toko/getToko',
        data: {
            id: id,
        },
        success: function(response) {
            $('#id').val(response.id)
            $('#toko2').val(response.nama)
            $('#alamat2').val(response.alamat)
        },
        error: function() {
            error()
        }
    });
}

$(document).ready(function() {
    $('#frmtoko').validate({
        rules: {
            toko: {
                required: true,
            }
        },
        messages: {
            toko: {
                required: "Masukan Toko",
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
                url: '<?= base_url() ?>toko/addToko',
                data: {
                    toko: $('#toko').val(),
                    alamat: $('#alamat').val(),
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
    $('#frmedit').validate({
        rules: {
            toko2: {
                required: true,
            }
        },
        messages: {
            toko2: {
                required: "Masukan Toko",
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
                url: '<?= base_url() ?>toko/editToko',
                data: {
                    id: $('#id').val(),
                    toko: $('#toko2').val(),
                    alamat: $('#alamat2').val()
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


function hapus(id) {
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
                url: '<?= base_url() ?>Toko/hapus',
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