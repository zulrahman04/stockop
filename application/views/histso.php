<div class="card">
    <!-- <div class="card-header"> -->
    <!-- <button class="btn btn-primary" onclick="formRole()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button> -->
    <!-- </div> -->
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="mydata">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Produk</th>
                        <th>toko</th>
                        <th>qty</th>
                        <th>expire</th>
                        <th>keterangan</th>
                        <th>create by</th>
                        <th>create date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th width="5%"></th>
                        <th><input class="form-control" id="produk" value="<?= $this->session->userdata('produk') ?>" />
                        </th>
                        <th><input class="form-control" id="toko" value="<?= $this->session->userdata('produk') ?>" />
                        </th>
                        <th><input class="form-control" id="qty" value="<?= $this->session->userdata('qty') ?>" /></th>
                        <th><input class="form-control" id="exp" value="<?= $this->session->userdata('exp') ?>" /></th>
                        <th><input class="form-control" id="ket" value="<?= $this->session->userdata('ket') ?>" /></th>
                        <th><input class="form-control" id="by" value="<?= $this->session->userdata('by') ?>" /></th>
                        <th><input class="form-control" id="date" value="<?= $this->session->userdata('date') ?>" />
                        </th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <!-- <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
      </div> -->
    <!-- /.card-footer -->
</div>
<!-- /.card -->
<!-- /.content -->

<script>
$(document).ready(function() {

    table = $('#mydata').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>Histso/listHist",
            "type": "POST"
        },
    });
});

$("#produk").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/produk',
        data: {
            produk: $('#produk').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#toko").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/toko',
        data: {
            toko: $('#toko').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#qty").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/qty',
        data: {
            qty: $('#qty').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#exp").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/exp',
        data: {
            exp: $('#exp').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#ket").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/ket',
        data: {
            ket: $('#ket').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#by").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/by',
        data: {
            by: $('#by').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})

$("#date").on("keyup", function() {
    $.ajax({
        dataType: "json",
        type: 'POST',
        url: '<?= base_url() ?>Histso/date',
        data: {
            date: $('#date').val()
        },
        success: function(data) {
            if (data == 'sukses') {
                table.ajax.reload()
            }
        },
        error: function() {
            // error()
        }
    });
})
</script>