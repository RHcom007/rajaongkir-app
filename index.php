<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ongkos ongkir</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: #eee
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(0, 123, 255, .25)
        }

        .btn-secondary:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
        }

        .close:focus {
            box-shadow: 0 0 0 0rem rgba(108, 117, 125, .5)
        }

        .mt-200 {
            margin-top: 200px
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center h-100">
        <div id="smartwizard" class="w-100">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#step-1">
                        <div class="num">1</div>
                        Identitas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-2">
                        <span class="num">2</span>
                        Alamat</br>
                        Tujuan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#step-3">
                        <span class="num">3</span>
                        Item
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#step-4">
                        <span class="num">4</span>
                        Informasi
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                    <div class="row">
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Nama" required> </div>
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Email" required> </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Password" required> </div>
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Repeat password" required> </div>
                    </div>
                </div>
                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                    <label for="">Alamat utama</label>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" id="provinsi_utama" required>
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="kota_utama" required>
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>
                    </div>
                    <label class="mt-2" for="">Alamat Destinasi</label>
                    <div class="row mt-1">
                        <div class="col-md-6">
                            <select class="form-control" id="provinsi_destinasi" required>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" id="kota_destinasi" required>
                                <option value="">Pilih Kota</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                    <div class="row">
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Nama Barang" required> </div>
                        <div class="col-md-6">
                            <select class="form-control" id="kurir_barang" required>
                                <option value="">Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"> <input id="berat_barang" type="text" class="form-control" placeholder="Berat (Gram)" id="berat_barang" required> </div>
                        <div class="col-md-6"> <input type="text" class="form-control" placeholder="Ukuran" required> </div>
                    </div>
                </div>
                <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                    Step content
                </div>
            </div>

            <!-- Include optional progressbar HTML -->
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/smartwizard@6/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

            function getProvinsi() {
                $.ajax({
                    url: '/api.php?prov',
                    type: 'GET',
                    success: function(response) {
                        var data = JSON.parse(response);
                        var options = '<option value="">Pilih Provinsi</option>';
                        $.each(data.rajaongkir.results, function(index, provinsi) {
                            options += '<option value="' + provinsi.province_id + '">' + provinsi.province + '</option>';
                        });
                        $('#provinsi_utama, #provinsi_destinasi').html(options);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            // Panggil fungsi untuk mengambil data provinsi saat halaman dimuat
            getProvinsi();

            // Event listener ketika memilih provinsi utama
            $('#provinsi_utama').change(function() {
                var selectedProvinsiId = $(this).val();
                if (selectedProvinsiId !== '') {
                    getKota(selectedProvinsiId, 'kota_utama');
                } else {
                    $('#kota_utama').html('<option value="">Pilih Kota</option>');
                }
            });

            // Event listener ketika memilih provinsi destinasi
            $('#provinsi_destinasi').change(function() {
                var selectedProvinsiId = $(this).val();
                if (selectedProvinsiId !== '') {
                    getKota(selectedProvinsiId, 'kota_destinasi');
                } else {
                    $('#kota_destinasi').html('<option value="">Pilih Kota</option>');
                }
            });

            // Fungsi untuk mengambil data kota berdasarkan provinsi dari API
            function getKota(provinsi_id, target_id) {
                $.ajax({
                    url: '/api.php?city=' + provinsi_id,
                    type: 'GET',
                    success: function(response) {
                        var data = JSON.parse(response);
                        var options = '<option value="">Pilih Kota</option>';
                        $.each(data.rajaongkir.results, function(index, kota) {
                            var optionValue = kota.city_id;
                            var optionText = kota.type + ' ' + kota.city_name;
                            options += '<option value="' + optionValue + '">' + optionText + '</option>';
                        });
                        $('#' + target_id).html(options);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }

            function provideContent(idx, stepDirection, stepPosition, selStep, callback) {
                // You can use stepDirection to get ajax content on the forward movement and stepPosition to identify the step position
                if (stepPosition == 'last') {
                    let ajaxURL = "/api.php?cost";

                    // Ajax call to fetch your content
                    $.ajax({
                        url: ajaxURL,
                        method: "POST",
                        data: {
                            'awal': $("#kota_utama").val(),
                            'tujuan': $("#kota_destinasi").val(),
                            "berat_barang": $("#berat_barang").val(),
                            "kurir": $("#kurir_barang").val(),
                        },
                        beforeSend: function(xhr) {
                            // Show the loader
                            $('#smartwizard').smartWizard("loader", "show");
                        }
                    }).done(function(res) {
                        var data = JSON.parse(res);
                        console.log(data);
                        var result = ""; // Inisialisasi dengan string kosong
                        $.each(data.rajaongkir.results[0].costs, function(index, detailnya) {
                            result += `<table class='mt-2'><tr><td>Nama Service </td><td>: ${detailnya.description}</td></tr>
               <tr><td>Harga </td><td>: Rp. ${detailnya.cost[0].value}</td></tr>
               <tr><td>Waktu Pengiriman </td><td>: ${detailnya.cost[0].etd} Hari</td></tr></table>`;
                        });

                        let html = `<div class="card w-100" >
                <div class="card-body">
                    <table>
                        <tr><td>Kota Utama </td><td>: ${data.rajaongkir.origin_details.type}  ${data.rajaongkir.origin_details.city_name}</td></tr>
                        <tr><td>Kota Tujuan </td><td>: ${data.rajaongkir.destination_details.type}  ${data.rajaongkir.destination_details.city_name}</td></tr>
                        <tr><td>Kurir </td><td>: ${data.rajaongkir.results[0].name}</td></tr>
                    </table>
                        ${result} <!-- Tambahkan variabel result di sini -->
                </div>
            </div>`;
                        callback(html);
                        $('#smartwizard').smartWizard("loader", "hide");
                    }).fail(function(err) {
                        $('#smartwizard').smartWizard("loader", "hide");
                    });
                }
                callback();
            }
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                autoAdjustHeight: true,
                transitionEffect: 'fade',
                showStepURLhash: false,
                getContent: provideContent
            });

        });
    </script>
</body>

</html>