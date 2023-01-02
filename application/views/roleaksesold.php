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
                        <?php $no = 1;
                            $code = $this->uri->segment(3);    
                            foreach ($role as $key) {
                                    $sub_menu = $this->db->query(" SELECT
                                    mnu_mstr.mnu_name
                                    , mnu_mstr.mnu_parent
                                    , mnu_mstr.mnu_id
                                    , accs_mstr.accs_tf
                                FROM
                                    accs_mstr
                                    INNER JOIN mnu_mstr
                                        ON (accs_mstr.accs_menu = mnu_mstr.mnu_id) WHERE accs_role = '$code' and  mnu_parent = '$key->mnu_id' and mnu_parent !='0'")->result();    
                                ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td>
                                        <?= $key->mnu_name; ?>
                                        <table>
                                            <?php 
                                            foreach ($sub_menu as $key2) {?>
                                                <tr>
                                                    <td style="width: 3%;"></td>
                                                <td style="width: 100%;"><?= $key2->mnu_name; ?> </td>                                    
                                                <td ><?php if ($key2->accs_tf == '0') {?>
                                                    <input type="checkbox" id="<?= $key->mnu_id?>" name="<?= $key2->mnu_id?>" value="<?= $key2->mnu_id?>" onclick="check(<?= $key2->mnu_id?>,'<?= $code?>')">
                                                    <?php }else{?>
                                                    <input type="checkbox" id="<?= $key->mnu_id?>" name="<?= $key2->mnu_id?>" value="<?= $key2->mnu_id?>" checked onclick="check(<?= $key2->mnu_id?>,'<?= $code?>')">
                                                    <?php }?></td>
                                                </tr>
                                            <?php 
                                            }?>
                                        </table>
                                        <td><?php if ($key->accs_tf == '0') {?>
                                            <input type="checkbox" id="box" name="<?= $key->mnu_id?>" value="<?= $key->mnu_id?>" onclick="check(<?= $key->mnu_id?>,'<?= $code?>')">
                                            <?php }else{?>
                                            <input type="checkbox" id="box" name="<?= $key->mnu_id?>" value="<?= $key->mnu_id?>" onclick="check(<?= $key->mnu_id?>,'<?= $code?>')" checked>
                                            <?php }?>
                                        </td>
                                    </td>
                                </tr>
                                <?php $no++;
                            } ?> 

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