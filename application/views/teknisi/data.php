<h1>Daftar Teknisi</h1>
<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary btn-sm mb-3" onclick="add()">
            Tambah Data <i class="fa fa-plus"></i>
        </button>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" id="listdata">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Opsi</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-group">
                        <input type="hidden" name="id">
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="lng" name="lon">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control form-control-sm" placeholder="Masukan Nama">
                        <small class="help-block"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" placeholder="Masukan Email">
                        <small class="help-block"></small>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="tempat_lahir" name="tempat_lahir" class="form-control form-control-sm" placeholder="Masukan Tempat Lahir">
                                <small class="help-block"></small>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control form-control-sm">
                                <small class="help-block"></small>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Telepon</label>
                        <input type="number" name="telepon" class="form-control form-control-sm" placeholder="Masukan No Telepon">
                        <small class="help-block"></small>

                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3"></textarea>
                        <small class="help-block"></small>

                    </div>
                    <button type="button" class="btn btn-success btn-sm mb-2" id="showMap">Posisi Map <i class="fa fa-map-marked"></i></button>
                    <div height="100px" width="10px" id="mapid"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup <i class="fa fa-times"></i></button>
                <button type="button" id="btn_submit" class="btn btn-sm btn-primary"> <i class="fa fa-save"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
    var method;
    $(document).ready(function() {
        $('#modalForm').hide();
        $('#modalForm').on('show.bs.modal', function() {
            $('#btn_submit').click(function() {
                save();
            });
            $('#mapid').hide();
            $('#showMap').click(function() {
                $('#mapid').show();
                setTimeout(function() {
                    var mymap = L.map('mapid').setView([-6.2868, 106.9072], 12);
                    var popup = L.popup();
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'pk.eyJ1IjoiaW5kcmFiYXN1a2kiLCJhIjoiY2trbnRpZGpsMmU3djMycGRiZm51NmcyYSJ9.1C4JFEjzTJmWisDFBHQIGg'
                    }).addTo(mymap);

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Koordinat Anda Di " + e.latlng.toString())
                            .openOn(mymap);
                        $('#lat').val(e.latlng.lat)
                        $('#lng').val(e.latlng.lng)
                    }

                    mymap.on('click', onMapClick);
                }, 10);
            })
        });
        table = $("#listdata").DataTable({
            initComplete: function() {
                var api = this.api();
                $("#listdata_filter input")
                    .off(".DT")
                    .on("keyup.DT", function(e) {
                        api.search(this.value).draw();
                    });
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            oLanguage: {
                sProcessing: "Silahkan tunggu"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: base_url + "teknisi/datatable",
                type: "POST"
            },
            columns: [{
                    data: "id",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nama"
                },
                {
                    data: "email"
                },
                {
                    data: "telepon"
                },
                {
                    data: "alamat"
                }
            ],
            columnDefs: [{
                searchable: false,
                targets: 5,
                data: {
                    id: "id",
                    ada: "ada"
                },
                render: function(data, type, row, meta) {
                    let btn;
                    return `<div class="text-center">
									<a class="badge badge-warning" href="#" onclick="edit(${data.id})">
										<i class="fa fa-edit">Edit</i>
                                    </a>
                                    <a class="badge badge-danger" href="#"  onclick="destroy(${data.id})"
										<i class="fa fa-trash">Delete</i>
									</a>
								</div>`;
                }
            }, {
                searchable: false,
                targets: 6,
                data: {
                    id: "id",
                    ada: "ada"
                },
                render: function(data, type, row, meta) {
                    let btn;
                    return `<div class="text-center">
									<a class="badge badge-success" href="${base_url}teknisi/map">
										<i class="fa fa-map-marked">View</i>
									</a>
								</div>`;
                }
            }],
            order: [
                [1, "asc"]
            ],
            rowId: function(a) {
                return a;
            },
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $("td:eq(0)", row).html(index);
            }
        });
    });

    function add() {
        method = 'add';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modalForm').modal('show');
        $('#btn_submit').text('Simpan');
        $('.modal-title').text('Tambah Data Teknisi');
        $('[name="nama"]').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
    }

    function save() {
        $('#btn_submit').text('Simpan Data');
        $('#btn_submit').attr('disabled', true);
        var url;
        if (method == 'add') {
            url = base_url + 'teknisi/add';
        } else {
            url = base_url + 'teknisi/update';
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#modalForm').modal('hide');
                    Swal({
                        "title": "Success",
                        "text": data.message,
                        "type": "success"
                    })
                    table.ajax.reload(null, false);
                } else {
                    $.each(data.errors, function(key, value) {
                        $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(value);
                        $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                        if (value == '') {
                            $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                            $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                        }
                    });
                }
                $('#btn_submit').attr('disabled', false); //set button enable 

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btn_submit').text('Simpan'); //change button text
                $('#btn_submit').attr('disabled', false); //set button enable 

            }
        });
    }

    function edit(id) {
        method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url: base_url + "teknisi/get_id/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="nama"]').keyup(function() {
                    $(this).val($(this).val().toUpperCase());
                });
                $('[name="id"]').val(data.id);
                $('[name="nama"]').val(data.nama);
                $('[name="email"]').val(data.email);
                $('[name="tempat_lahir"]').val(data.tempat_lahir);
                $('[name="tanggal_lahir"]').val(data.tanggal_lahir);
                $('[name="telepon"]').val(data.telepon);
                $('[name="alamat"]').val(data.alamat);
                $('#modalForm').modal('show');
                $('.modal-title').text('Edit Data Teknisi');
                $('#mapid').show();
                setTimeout(function() {
                    var mymap = L.map('mapid').setView([data.lat, data.lon], 12);
                    var popup = L.popup();

                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'pk.eyJ1IjoiaW5kcmFiYXN1a2kiLCJhIjoiY2trbnRpZGpsMmU3djMycGRiZm51NmcyYSJ9.1C4JFEjzTJmWisDFBHQIGg'
                    }).addTo(mymap);
                    L.marker([data.lat, data.lon]).addTo(mymap);

                    function onMapClick(e) {
                        popup
                            .setLatLng(e.latlng)
                            .setContent("Koordinat Anda Di " + e.latlng.toString())
                            .openOn(mymap);
                        $('#lat').val(e.latlng.lat)
                        $('#lng').val(e.latlng.lng)
                    }
                    mymap.on('click', onMapClick);
                }, 10);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function destroy(id) {
        if (confirm('Apakah ingin menghapus data?')) {
            $.ajax({
                url: base_url + "teknisi/delete/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    Swal({
                        "title": "Success",
                        "text": data.message,
                        "type": "success"
                    })
                    table.ajax.reload(null, false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }
</script>