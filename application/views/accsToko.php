<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- <div class="card-header">
            </div> -->
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
                                    <a href="#" class="btn btn-info" onclick="modal('<?= $key->id ?>')"><i class="fa fa-fw fa-eye"></i></a>
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

<div class="modal fade" id="modal-akses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="mydata" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th style='width: 10%;'>No</th>
                            <th style='width:80%'>Toko</th>
                            <th style='width:40%'>Alamat</th>
                            <th style='width:10%'>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>


<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('.select2').select2()

    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    })


    function modal(id) {
        $('#modal-akses').modal()
        table = $('#mydata').DataTable({
            "bDestroy": true,
            "processing": false,
            "serverSide": true,
            "paging": false,
            "ordering": false,
            "searching": false,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>Accs_toko/listAkses",
                "type": "POST",
                "data": {
                    id: id
                }
            },
        });
        table.ajax.reload()
    }


    function check(id, ids) {
        console.log(ids)
        // Get the checkbox
        var checkBox = document.getElementById(id);
        // If the checkbox is checked, display the output text
        if ($('input[name="' + id + '"').is(':checked')) {
            $('input[id="' + id + '"').prop('checked', true);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?= base_url() . 'Accs_toko/checkAccs' ?>",
                data: {
                    id: id,
                    ids: ids
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil Menambahkan access.'
                    })
                },
                error: function() {
                    // error()
                }
            });
        } else {
            $('input[id="' + id + '"').prop('checked', false);
            var parent = document.getElementById(id);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?= base_url() . 'Accs_toko/unCheckAccs' ?>",
                data: {
                    id: id,
                    ids: ids
                },
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil membatalkan access'
                    })
                },
                error: function() {
                    // error()
                }
            });
        }
    }

    function uncheck(id) {
        console.log(id)
    }
</script>