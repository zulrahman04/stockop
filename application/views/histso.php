

<link href="<?= base_url('assets/'); ?>bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="<?= base_url('assets/'); ?>bootstrap-table/dist/bootstrap-table.js"></script>

<link rel="stylesheet" href="<?= base_url('assets/'); ?>icons-1.10.2/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.css">
<script src="<?= base_url('assets/'); ?>bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.min.js">
</script>
<script src="<?= base_url('assets/'); ?>dist/bootstrap.bundle.min.js"></script>  
<div class="card">
    <!-- <div class="card-header"> -->
    <!-- <button class="btn btn-primary" onclick="formRole()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button> -->
    <!-- </div> -->
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover table-condensed" id="table" data-toggle="table"
            data-side-pagination="server" data-url="<?= base_url('Histso/listHist'); ?>" data-page-size="50"
            data-page-list="[10, 25, 50, 100, All]" data-pagination="true" data-sort-name="create_date"
            data-sort-order="asc" data-filter-control="true" data-show-search-clear-button="true">
            <thead>
                <tr>
                    <th data-formatter="runningFormatterServerSide" data-field="no">No</th>
                    <th data-field="nama_produk" data-sortable="true" data-filter-control="input">Produk</th>
                    <th data-field="toko" data-sortable="true" data-filter-control="input">toko</th>
                    <th data-field="qty" data-sortable="true" data-filter-control="input">qty</th>
                    <th data-field="expire" data-sortable="true" data-filter-control="datepicker" data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true, "orientation": "top"}'>expire</th>
                    <th data-field="keterangan" data-sortable="true" data-filter-control="input">keterangan</th>
                    <th data-field="create_by" data-sortable="true" data-filter-control="input">create by</th>
                    <th data-field="create_date" data-sortable="true" data-filter-control="datepicker">create date</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>


$(function() {
    $('#table').bootstrapTable()
})

function runningFormatterServerSide(value, row, index) {
    var $table = $('#table');
    var tableOptions = $table.bootstrapTable('getOptions');
    if (tableOptions.pageSize == 'All') {
        return index + 1;
    } else {
        return ((tableOptions.pageNumber - 1) * tableOptions.pageSize) + (1 + index);
    }

}
</script>