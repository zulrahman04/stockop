
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- jquery validation -->
        <div class="card card-primary">
          <!-- <div class="card-header">
            <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
          </div> -->
          <!-- /.card-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="card-body">
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" id="id" value="<?= $usrid ?>" placeholder="username" readonly>
                  <input type="text" class="form-control" id="username" value="<?= $usrnm ?>" placeholder="username" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" value="<?= $pswd ?>" placeholder="password" readonly>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">                  
                <button type="button" class="btn btn-info float-right" onclick="formUbahPass()">
                Ubah Password
                </button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
<!-- /.content -->

<div class="modal fade" id="modal-ubahpass">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Form Ubah Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form class="form-horizontal" id="frmNewPswd">
              <div class="modal-body">
                  <div class="form-body">
                      <div class="form-group">
                          <label for="oldpswd">Password Lama
                              <span class="text-danger"> * </span>
                          </label>
                          <input type="password" id="oldpswd" name="oldpswd" class="form-control"/>
                      </div>
                      <div class="form-group">
                          <label for="newpswd">Password Baru
                              <span class="text-danger"> * </span>
                          </label>
                          <input type="password" id="newpswd" name="newpswd" class="form-control"  />
                      </div>
                      <div class="form-group">
                          <label for="reppswd">Ulangi Password Baru
                              <span class="text-danger"> * </span>
                          </label>
                          <input type="password" id="reppswd" name="reppswd" class="form-control"/>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
      </div>
      <!-- /.modal-content -->
  </div>
</div>
    <!-- /.modal-dialog -->
<!-- /.modal -->
<script type="text/javascript">
    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                if ($('#newpswd').val() != $('#reppswd').val()) {
                      Swal.fire({
                        icon: 'info',
                        title: 'Password baru tidak sama.',
                        showConfirmButton: false,
                        timer: 1500
                      })
                    return
                }      
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: "<?= base_url() . 'myaccount/changePassword' ?>",
                    data: {
                        oldpswd: $('#oldpswd').val(),
                        newpswd: $('#newpswd').val(),
                        reppswd: $('#reppswd').val()
                    },
                    success: function(response) {
                        if(response.result == 'Berhasil'){
                            Swal.fire({
                            icon: 'success',
                            title: 'Password Berhasil diubah.',
                            showConfirmButton: false,
                            timer: 1500
                          })
                            $('#modal-ubahpass').modal('toggle')
                        }else if(response.result == 'Gagal'){          
                            errortr(response.message)
                        }           
                    },
                    error: function() {        
                        error()
                    }
                });
            }
        });    

        $('#frmNewPswd').validate({
            rules: {
                oldpswd: {
                    required: true
                },
                    newpswd: {
                    required: true,
                    minlength: 6
                },
                reppswd: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                oldpswd: {
                    required: "Please provide a password",
                },
                    newpswd: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                reppswd: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                }
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
            }
        });
    });
    function formUbahPass(){
        $('#oldpswd').val('')
        $('#newpswd').val('')
        $('#reppswd').val('')
        $('#modal-ubahpass').modal()
    }
</script>