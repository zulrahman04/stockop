<div class="row">
    <div class="col-md-12" align="center">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header" align="center">
                    <h3 class="card-title">INPUT SO <?= $toko->nama ?></h3>
                </div>

                <form id="inptso">
                    <div class="card-body">
                        <div class="form-group">
                            <video id="previewKamera" style="width: 300px;height: 300px;"></video>
                        </div>
                        <div class="form-group">
                            <select id="pilihKamera" style="max-width:400px">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hasilscan">Barcode</label>
                            <input type="text" class="form-control" id="hasilscan" placeholder="Hasil Scan">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="cek">Cek Barcode</button>
                        </div>


                        <div class="form-group">
                            <label for="produk">Produk</label>
                            <select id="produk" name="produk" class="form-control select2">
                                <option value="">Pilih</option>
                                <?php foreach ($itm as $key) { ?>
                                    <option value="<?= $key->id ?>"><?= $key->kode_item . ' - ' . $key->nama ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <button type="button" class="btn btn-primary" id="cek2">Cek Produk</button>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kditem">Kode Item</label>
                                    <input type="hidden" class="form-control" id="iditem" placeholder="Kode Item" readonly>
                                    <input type="hidden" class="form-control" id="id_toko" value="<?= $toko->id ?>" placeholder="Kode Item" readonly>
                                    <input type="text" class="form-control" id="kditem" name="kditem" placeholder="Kode Item" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" readonly>
                                </div>
                                <div class="form-group opt">
                                    <label for="opt">Option</label>
                                    <select id="opt" name="opt" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                                <div class="form-group optexp">
                                    <label for="optexp">Expire</label>
                                    <select id="optexp" name="optexp" class="form-control">
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                                <div class="form-group exp">
                                    <label for="exp">Expired</label>
                                    <select id="thn" name="thn" class="form-control">
                                        <option value="">Pilih Tahun</option>
                                        <?php for ($i = 1; $i < 8; $i++) {
                                            $year = '+' . $i . ' year';
                                            $lyear = date('Y', strtotime($year, strtotime(date("Y-m-d")))); ?>
                                            <option value="<?= $lyear  ?>">
                                                <?= $lyear  ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <select id="bln" name="bln" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <input type="tel" class="form-control" id="hr" name="hr" placeholder="Masukkan Tanggal" onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength="2">
                                </div>
                                <div class="form-group qtyact">
                                    <label for="qtyact">Qty Ready</label>
                                    <input type="tel" class="form-control" id="qtyact" name="qtyact" placeholder="Qty" onkeypress="return event.charCode >= 48 && event.charCode <=57" readonly>
                                </div>
                                <div class="form-group qty">
                                    <label for="qty">Qty</label>
                                    <input type="tel" class="form-control" id="qty" name="qty" placeholder="Qty" onkeypress="return event.charCode >= 48 && event.charCode <=57" maxlength="2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select2').select2();
    $('.opt').hide();
    $('.exp').hide();
    $('.qty').hide();
    $('.qtyact').hide();
    $('.optexp').hide();
    $("#opt").on("change", function() {
        if (this.value == 'masuk') {
            $('.exp').show();
            $('.qty').show();
            $('.qtyact').hide();
            $('.optexp').hide()
        } else if (this.value == 'keluar') {
            $('.optexp').show();
            $('.qty').show();
            $('.qtyact').show();
            $('.exp').hide()
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>dashboard/getExp',
                data: {
                    iditem: $('#iditem').val(),
                    id_toko: $('#id_toko').val()
                },
                success: function(data) {
                    var html = '';
                    html += '<option value=""> Pilih </option>';
                    for (var i = 0; i < data.length; i++) {
                        var myexp = data[i].expire.split("-")
                        html += '<option value=' + data[i].expire + '>' + myexp[2] + '/' + myexp[1] +
                            '/' + myexp[0] +
                            '</option>';
                    }
                    $('#optexp').html(html);
                },
                error: function() {
                    // error()
                }
            });
        } else {
            $('.exp').hide()
            $('.qty').hide()
            $('.qtyact').hide();
            $('.optexp').hide()
            $('.opt').hide();
        }


        $("#optexp").on("change", function() {
            console.log('s')
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>dashboard/getQtyRed',
                data: {
                    iditem: $('#iditem').val(),
                    id_toko: $('#id_toko').val(),
                    exp: $('#optexp').val()
                },
                success: function(data) {
                    console.log($('#optexp').val())
                    $('#qtyact').val(data.qty)
                },
                error: function() {
                    // error()
                }
            });

        })
    })

    $('#inptso').validate({
        rules: {
            kditem: {
                required: true
            },
            nama: {
                required: true
            },
            qty: {
                required: true,
            },
            thn: {
                required: true
            },
            bln: {
                required: true
            },
            hr: {
                required: true
            },
            opt: {
                required: true
            },
            optexp: {
                required: true
            }
        },
        messages: {
            kditem: {
                required: "Kode Item Tidak boleh kosong"
            },
            qty: {
                required: "Qty Tidak Boleh Kosong"
            },
            thn: {
                required: "Expire Tidak Boleh Kosong"
            },
            opt: {
                required: "Pilih option"
            },
            optexp: {
                required: "Pilih Expire"
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
            var exp
            if ($('#opt').val() == 'keluar') {
                if ($('#qty').val() > $('#qtyact').val()) {
                    alert("Stock Tidak Mencukupi")
                    return false
                }
                exp = $('#optexp').val()
            } else if ($('#opt').val() == 'masuk') {
                exp = $('#thn').val() + '-' + $('#bln').val() + '-' + $('#hr').val()
            }
            $.ajax({
                dataType: "json",
                type: 'POST',
                url: '<?= base_url() ?>dashboard/inptso',
                data: {
                    iditem: $('#iditem').val(),
                    id_toko: $('#id_toko').val(),
                    qty: $('#qty').val(),
                    exp: exp,
                    opt: $('#opt').val()
                },
                success: function(response) {
                    if (response.result == 'Berhasil') {
                        successtr(response.message)
                    } else {
                        errortr(response.message)
                    }
                },
                error: function() {
                    // error()
                }
            });
        }
    });
</script>

<script type="text/javascript" src="<?= base_url('assets') ?>/js/index.min.js"></script>
<script src="<?= base_url('assets') ?>/js/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $('#cek2').click(function(e) {
        $.ajax({
            dataType: "json",
            type: 'POST',
            url: '<?= base_url() ?>Dashboard/getProdukId',
            data: {
                id: $('#produk').val()
            },
            success: function(response) {
                if (response == 'Gagal') {
                    alert('Produk Tidak Ditemukan')
                } else {
                    $('#iditem').val(response.id)
                    $('#kditem').val(response.kode_item)
                    $('#barcode').val(response.barcode)
                    $('#nama').val(response.nama)
                    $('.opt').show();
                }
            },
            error: function() {
                error()
            }
        });
    });

    $('#cek').click(function(e) {
        $.ajax({
            dataType: "json",
            type: 'POST',
            url: '<?= base_url() ?>Dashboard/getProdukBarcode',
            data: {
                code: $('#hasilscan').val()
            },
            success: function(response) {
                if (response == 'Gagal') {
                    alert('Barcode Tidak Ditemukan')
                } else {
                    $('#iditem').val(response.id)
                    $('#kditem').val(response.kode_item)
                    $('#barcode').val(response.barcode)
                    $('#nama').val(response.nama)
                    $('.opt').show();
                }
            },
            error: function() {
                error()
            }
        });
    });

    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const sourceSelect = $("#pilihKamera");

    $(document).on('change', '#pilihKamera', function() {
        selectedDeviceId = $(this).val();
        if (codeReader) {
            codeReader.reset()
            initScanner()
        }
    })

    function initScanner() {
        codeReader
            .listVideoInputDevices()
            .then(videoInputDevices => {
                videoInputDevices.forEach(device =>
                    console.log(`${device.label}, ${device.deviceId}`)
                );

                if (videoInputDevices.length > 0) {

                    if (selectedDeviceId == null) {
                        if (videoInputDevices.length > 1) {
                            selectedDeviceId = videoInputDevices[1].deviceId
                        } else {
                            selectedDeviceId = videoInputDevices[0].deviceId
                        }
                    }


                    if (videoInputDevices.length >= 1) {
                        sourceSelect.html('');
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            if (element.deviceId == selectedDeviceId) {
                                sourceOption.selected = 'selected';
                            }
                            sourceSelect.append(sourceOption)
                        })

                    }

                    codeReader
                        .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                        .then(result => {

                            //hasil scan
                            console.log(result.text)
                            $("#hasilscan").val(result.text);
                            $("#hasilscan").focus()
                            if (codeReader) {
                                codeReader.reset()
                            }
                        })
                        .catch(err => console.error(err));

                } else {
                    alert("Camera not found!")
                }
            })
            .catch(err => console.error(err));
    }


    if (navigator.mediaDevices) {
        initScanner()
    } else {
        alert('Cannot access camera.');
    }
</script>