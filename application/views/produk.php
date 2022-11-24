<div class="card">
    <div class="card-header">
        <button class="btn btn-primary" onclick="formProduk()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button>
        <button class="btn btn-primary" onclick="formImport()"><i class="nav-icon fa fa-fw fa-upload"></i>
            Import</button>
        <button class="btn btn-primary" onclick="pexport()"><i class="nav-icon fa fa-fw fa-download"></i>
            Export</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered table-striped" id="mydata">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Item</th>
                    <th>Barcode</th>
                    <th>Nama</th>
                    <th>jenis</th>
                    <th>merk</th>
                    <th>satuan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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

<div class="modal fade" id="modal-addproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmproduk">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Kode Produk</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="kdpr" name="kdpr" class="form-control"
                                placeholder="Masukan Kode Produk">
                        </div>
                        <div class="form-group">
                            <label>Barcode</label>
                            <input type="text" id="barcode" name="barcode" class="form-control"
                                placeholder="Masukan Barcode">
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="produk" name="produk" class="form-control"
                                placeholder="Masukan Nama Produk">
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" id="jns" name="jns" class="form-control" placeholder="Masukan Jenis">
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <input type="text" id="merk" name="merk" class="form-control" placeholder="Masukan Merk">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" id="satuan" name="satuan" class="form-control"
                                placeholder="Masukan Satuan">
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

<div class="modal fade" id="modal-editproduk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Ubah Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" id="frmeditproduk">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <label>Kode Produk</label>
                            <span class="text-danger"> * </span>
                            <input type="hidden" id="id" name="id">
                            <input type="text" id="kdpr2" name="kdpr2" class="form-control"
                                placeholder="Masukan Kode Produk" readonly>
                        </div>
                        <div class="form-group">
                            <label>Barcode</label>
                            <input type="text" id="barcode2" name="barcode2" class="form-control"
                                placeholder="Masukan Barcode">
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <span class="text-danger"> * </span>
                            <input type="text" id="produk2" name="produk2" class="form-control"
                                placeholder="Masukan Nama Produk">
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" id="jns2" name="jns2" class="form-control" placeholder="Masukan Jenis">
                        </div>
                        <div class="form-group">
                            <label>Merk</label>
                            <input type="text" id="merk2" name="merk2" class="form-control" placeholder="Masukan Merk">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" id="satuan2" name="satuan2" class="form-control"
                                placeholder="Masukan Satuan">
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

<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="mydata2">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Toko</th>
                            <th>Qty</th>
                            <th>Expire</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?= base_url('produk/import') ?>" class="form-horizontal" id="import" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih file</label>
                        <input type="file" id="file" name="file" class="form-control" accept=".xlsx,.xlx" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="importexcel()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.card -->
<!-- /.content -->

<script>
function importexcel() {
    var file = $('#file').val()
    if (file != '') {
        $.LoadingOverlay("show");
    }
}
$(document).ready(function() {

    table = $('#mydata').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>produk/listProduk",
            "type": "POST"
        },
    });
});

function formProduk() {
    $('#kdpr').val('')
    $('#barcode').val('')
    $('#produk').val('')
    $('#jns').val('')
    $('#merk').val('')
    $('#satuan').val('')
    $('#modal-addproduk').modal()
}

function formImport() {
    $('#file').val('')
    $('#modal-import').modal()
}

function pexport() {
    window.open('<?= base_url() ?>produk/export', '_blank');
}

function formEditProduk(id) {
    $('#kdpr2').val('')
    $('#barcode2').val('')
    $('#produk2').val('')
    $('#jns2').val('')
    $('#merk2').val('')
    $('#satuan2').val('')
    $('#id').val('')
    $('#modal-editproduk').modal()

    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>produk/getProduk',
        data: {
            id: id,
        },
        success: function(response) {
            $('#id').val(response.id)
            $('#kdpr2').val(response.kode_item)
            $('#barcode2').val(response.barcode)
            $('#produk2').val(response.nama)
            $('#jns2').val(response.jenis)
            $('#merk2').val(response.merk)
            $('#satuan2').val(response.satuan)
        },
        error: function() {
            error()
        }
    });
}

$(document).ready(function() {
    $('#frmproduk').validate({
        rules: {
            kdpr: {
                required: true,
            },
            produk: {
                required: true
            }
        },
        messages: {
            kdpr: {
                required: "Masukan Kode Produk",
            },
            produk: {
                required: "Masukan Nama Produk"
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
                url: '<?= base_url() ?>produk/addProduk',
                data: {
                    kdpr: $('#kdpr').val(),
                    barcode: $('#barcode').val(),
                    produk: $('#produk').val(),
                    jns: $('#jns').val(),
                    merk: $('#merk').val(),
                    satuan: $('#satuan').val()
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
    $('#frmeditproduk').validate({
        rules: {
            kdpr2: {
                required: true,
            },
            produk2: {
                required: true
            }
        },
        messages: {
            kdpr2: {
                required: "Masukan Kode Produk",
            },
            produk2: {
                required: "Masukan Nama Produk"
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
                url: '<?= base_url() ?>produk/editProduk',
                data: {
                    id: $('#id').val(),
                    kdpr: $('#kdpr2').val(),
                    barcode: $('#barcode2').val(),
                    produk: $('#produk2').val(),
                    jns: $('#jns2').val(),
                    merk: $('#merk2').val(),
                    satuan: $('#satuan2').val()
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

function modal(id) {
    $('#modal-detail').modal('toggle');
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>produk/listProdukDetail/' + id,
        data: {},
        success: function(data) {
            console.log(data)
            $('#data').html(data)
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
                url: '<?= base_url() ?>produk/hapusProduk',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#mydata').DataTable().ajax.reload();
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