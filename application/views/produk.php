<div class="card">
    <div class="card-header">
        <button class="btn btn-primary" onclick="formRole()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
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
            "url": "<?= base_url() ?>produk/listProduk",
            "type": "POST"
        },
    });
});
</script>