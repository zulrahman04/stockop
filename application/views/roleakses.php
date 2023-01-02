<?php
$base_url = base_url();
?>    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table" class="table table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Access</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?= $dt ?>
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


<script type="text/javascript">   
     const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    function check(id,role) {
        // Get the checkbox
        var checkBox = document.getElementById(id);
        // If the checkbox is checked, display the output text
        if ($('input[name="'+id+'"').is(':checked')){
            $('input[id="'+id+'"').prop('checked', true);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?= $base_url . 'rolemstr/checkAccs' ?>",
                data: {
                    id: id,
                    role:role
                },
                success: function(response) {
                    if (response.result != 0 && response.result2 == 'N') {
                        $('input[name="'+response.result+'"').prop('checked', true);
                    }      
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil Menambahkan access.'
                    })
                },
                error: function() {
                    error()
                }
            });
        } else{
            $('input[id="'+id+'"').prop('checked', false);
            var parent = document.getElementById(id);
            $.ajax({
                dataType: "json",
                type: "POST",
                url: "<?= $base_url . 'rolemstr/unCheckAccs' ?>",
                data: {
                    id: id,
                    role:role
                },
                success: function(response) {
                    if (response.result < 1) {
                        $('input[name="'+response.result2+'"').prop('checked', false);
                    }       
                    Toast.fire({
                        icon: 'success',
                        title: 'Berhasil membatalkan access'
                    })
                },
                error: function() {          
                    error()
                }
            });
        }
    }
    </script>