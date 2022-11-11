
    <div class="row">
      <div class="col-12">
        <div class="card">
              <div class="card-header">
                <button class="btn btn-primary" onclick="formRole()"><i class="nav-icon fa fa-fw fa-plus"></i> Tambah</button>
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Code Role</th>
                      <th>Nama Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    foreach ($role as $key) {?>
                    <tr>
                      <td><?= $no++?></td>
                      <td><?= $key->rol_code?></td>
                      <td><?= $key->rol_name?></td>
                      <td><?= $key->rol_status?></td>
                      <td>
                        <a href="<?= base_url() ?>rolemstr/access/<?= $key->rol_code?>" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i></a>
                        <button class="btn btn-info" onclick="formEditRole(<?= $key->id ?>)"><i class="fa fa-fw fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="deleteMenu(<?= $key->id ?>,'<?= $key->rol_code ?>')"><i class="fa fa-fw fa-trash"></i></button>
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


<div class="modal fade" id="modal-addrole">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Form Tambah Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form class="form-horizontal" id="frmNewRole">
            <div class="modal-body">
              <div class="form-body">
                  <div class="form-group">
                      <label for="cdrole">Code Role
                          <span class="text-danger"> * </span>
                      </label>
                      <input type="text" id="cdrole" name="cdrole" class="form-control" onkeyup="capital()"/>
                  </div>
                  <div class="form-group">
                      <label for="nmrole">Nama Role
                          <span class="text-danger"> * </span>
                      </label>
                      <input type="text" id="nmrole" name="nmrole" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="sts" name="sts">
                      <option value="A">Active</option>
                      <option value="I">Inactive</option>
                    </select>
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

<div class="modal fade" id="modal-editrole">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Form Edit Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form class="form-horizontal" id="frmEditRole">
            <div class="modal-body">
              <div class="form-body">
                  <div class="form-group">
                      <label for="cdrole2">Code Role
                          <span class="text-danger"> * </span>
                      </label>
                      <input type="hidden" id="id" name="id" class="form-control"/>
                      <input type="hidden" id="cdroleold" name="cdroleold" class="form-control"/>
                      <input type="text" id="cdrole2" name="cdrole2" class="form-control" onkeyup="capital()"/>
                  </div>
                  <div class="form-group">
                      <label for="nmrole2">Nama Role
                          <span class="text-danger"> * </span>
                      </label>
                      <input type="text" id="nmrole2" name="nmrole2" class="form-control"/>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="sts2" name="sts2">
                      <option value="A">Active</option>
                      <option value="I">Inactive</option>
                    </select>
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

<script>
  
  $("#example1").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
  $(document).ready(function () { 
    $('#frmNewRole').validate({
        rules: {
                cdrole: {
                required: true,
                maxlength: 5
            },
                nmrole: {
                required: true
            }
        },
        messages: {
                cdrole: {
                required: "Masukan Code Role",
                maxlength: "Panjang Code maximal 5 karakter"
            },
                nmrole: {
                required: "Masukan Nama Role"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },

        submitHandler: function () {
            $.ajax({
            dataType: "json",
            type: 'POST', 
            url: '<?= base_url() ?>rolemstr/addRole',
            data: {
                cdrole: $('#cdrole').val(),
                nmrole: $('#nmrole').val(),
                sts: $('#sts').val()
            },
            success: function(response) { 
              if (response.result == 'Berhasil') {
                successtr(response.message)
              }else{
                erortr(response.message)
              }
            },
            error: function() {    
              error()
            }
          });
        }
    });
    $('#frmEditRole').validate({
        rules: {
              cdrole2: {
                required: true,
                maxlength: 5
            },
            nmrole2: {
                required: true
            }
        },
        messages: {
                cdrole2: {
                required: "Masukan Code Role",
                maxlength: "Panjang Code maximal 5 karakter"
            },
                nmrole2: {
                required: "Masukan Nama Role"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        
        submitHandler: function () {
            $.ajax({
            dataType: "json",
            type: 'POST', 
            url: '<?= base_url() ?>rolemstr/saveEditRole',
            data: {
                id: $('#id').val(),
                cdroleold: $('#cdroleold').val(),
                cdrole2: $('#cdrole2').val(),        
                nmrole2: $('#nmrole2').val(),        
                sts2: $('#sts2').val()
            },
            success: function(response) { 
              if (response.result == 'Berhasil') {
                successtr(response.message)
              }else{
                erortr(response.message)
              }
            },
            error: function() {        
              error()
            }
          });
        }
    });
  });  
  function capital() {
    var x = document.getElementById("cdrole");
    x.value = x.value.toUpperCase();
  }
  function formRole(){
    $('#nmrole').val('')
    $('#cdrole').val('')
    $('#modal-addrole').modal()
  }    
  function formEditRole(id){
    $('#id').val('')
    $('#cdroleold').val('')
    $('#nmrole2').val('')
    $('#cdrole2').val('')
    $('#modal-editrole').modal()
    $.ajax({
      dataType: "json",
      type: 'POST', 
      url: '<?= base_url() ?>rolemstr/getEditRole',
      data: {
        id: id
      },
      success: function(response) { 
        $('#id').val(response.id)
        $('#cdroleold').val(response.rol_code)
        $('#nmrole2').val(response.rol_code)
        $('#cdrole2').val(response.rol_name)
      },
      error: function() {
        error()
      }
    });
  }
  function deleteMenu(id,code){
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
          url: '<?= base_url() ?>rolemstr/deleteRole',
          data: {
            id: id,
            code: code
          },
          success: function(response) { 
            if (response.result == 'Berhasil') {
                successtr(response.message)
            }else{
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