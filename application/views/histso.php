<link href="<?= base_url('assets/'); ?>bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">

<link rel="stylesheet" href="<?= base_url('assets/'); ?>icons-1.10.2/font/bootstrap-icons.css">
<script src="<?= base_url('assets/'); ?>bootstrap-table/dist/bootstrap-table.js"></script>

<script
    src="<?= base_url('assets/'); ?>bootstrap-table/dist/extensions/filter-control/bootstrap-table-filter-control.js">
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
                    <th data-field="nama_produk" data-filter-control="input">Produk</th>
                    <th data-field="toko" data-filter-control="input">toko</th>
                    <th data-field="qty" data-filter-control="input">qty</th>
                    <th data-field="expire" data-filter-control="datepicker">expire</th>
                    <th data-field="keterangan" data-filter-control="input">keterangan</th>
                    <th data-field="create_by" data-filter-control="input">create by</th>
                    <th data-field="create_date" data-filter-control="datepicker">create date</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>


(function() {
    $('#table').bootstrapTable({
        data: AvailableSessions,
        //height
        height: 500,
        //adding native datepicker options
        ['data-filter-datepicker-options']: '{"startDate":' + new Date(AvailableSessions[0].Date) +
            ', "endDate":' + new Date(AvailableSessions[AvailableSessions.length - 1].Date) + '}'
    })
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