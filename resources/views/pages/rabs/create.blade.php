@extends('layouts.dashboard')

@section('title')
    E-RAB | RAB
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/selectric/public/selectric.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buat RAB</h1>
            </div>

            <div class="section-body">
                {{-- <h2 class="section-title">DataTables</h2>
                <p class="section-lead">
                    We use 'DataTables' made by @SpryMedia. You can check the full documentation <a
                        href="https://datatables.net/">here</a>.
                </p> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('rabs.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Kegiatan</span>
                                                </div>
                                                <select name="activity_id" id="activityTD" class="form-control">
                                                    <option value="">Pilih Kegiatan</option>
                                                    @foreach ($activities as $activity)
                                                        <option value="{{ $activity->id }}">{{ $activity->code }} -
                                                            {{ $activity->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Klasifikasi</span>
                                                </div>
                                                <select name="classification_id" id="classificationTD" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rincian</span>
                                                </div>
                                                <select name="detail_id" id="detailTD" class="form-control">
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Komponen</span>
                                                </div>
                                                <select name="component_id" id="componentTD" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Sub Komponen</span>
                                                </div>
                                                <select name="sub_component_id" id="sub_componentTD" class="form-control">
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mt-0 section-title">Sub Komponen :
                                                    <select name="sub_component_id" id="sub_componentTD"
                                                        class="form-control">
                                                    </select>
                                                </div>
                                                <div class="mt-0 section-title">Program :
                                                    <select name="program_id" class="form-control">
                                                        <option value="">Pilih Program</option>
                                                        @foreach ($programs as $program)
                                                            <option value="{{ $program->id }}">{{ $program->code }} -
                                                                {{ $program->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <table class="table table-hover" id="tabelRAB1">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" width="5%">#</th>
                                                            <th scope="col">Deskripsi</th>
                                                            <th scope="col" width="12%">Volume</th>
                                                            <th scope="col" width="15%">Satuan</th>
                                                            <th scope="col" width="18%">Harga</th>
                                                            <th scope="col" width="20%">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no = 1;
                                                            $noo = 1;
                                                        @endphp
                                                        <tr>
                                                            <th scope="row">{{ $no++ }}</th>
                                                            <td>
                                                                <textarea name="" id="" cols="30" rows="3" oninput="addRowIfNotEmpty(this)"></textarea>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" id="volume"
                                                                    name="volume" placeholder="0">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="unit"
                                                                    name="unit">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control currency"
                                                                    id="price" name="price">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control currency"
                                                                    id="total" name="total" placeholder="Rp. 0"
                                                                    readonly>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4" class="text-right">Total Keseluruhan</th>
                                                            <th colspan="3">Rp. 0</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Sumber Dana</span>
                                                </div>
                                                <select name="resource_id" id="resourceTD" class="form-control">
                                                    <option value="">Pilih Sumber Dana</option>
                                                    @foreach ($resources as $resource)
                                                        <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Kelompok Akun</span>
                                                </div>
                                                <select name="group_id" id="groupTD" class="form-control">
                                                </select>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Akun</span>
                                                </div>
                                                <select name="type_id" id="typeTD" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Banyak</span>
                            </div>
                            <input type="number" class="form-control" id="volume" name="volume"
                                placeholder="Volume">
                            <div class="input-group-append">
                                <span class="input-group-text">Harga</span>
                            </div>
                            <input type="text" class="form-control currency" id="frequency" name="frequency">
                            <div class="input-group-append">
                                <span class="input-group-text">Total</span>
                            </div>
                            <input type="text" class="form-control currency" id="price" name="price"
                                placeholder="Rp. 0" readonly>
                        </div>
                    </div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('prepend-script')
    <script src="/assets/js/page/forms-advanced-forms.js"></script>
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="/node_modules/cleave.js/dist/cleave.min.js"></script>
    <script src="/node_modules/cleave.js/dist/addons/cleave-phone.us.js"></script>
@endpush
@push('addon-script')
    <script>
        // Ambil elemen input
        const volumeInput = document.getElementById('volume');
        const priceInput = document.getElementById('price');
        const totalInput = document.getElementById('total');

        const currencyInputs = document.querySelectorAll('.currency');

        currencyInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Menghapus karakter selain angka
                let value = this.value.replace(/[^0-9]/g, '');

                // Format angka menjadi ribuan
                if (value.length > 3) {
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                }

                // Setel nilai input dengan format ribuan
                this.value = 'Rp. ' + value;
                updateTotal();
            });
        });

        volumeInput.addEventListener('input', function() {
            updateTotal();
        });

        function updateTotal() {
            const volume = parseFloat(volumeInput.value) || 0;
            const price = parseFloat(priceInput.value.replace(/[^0-9]/g, '')) || 0;
            const total = volume * price;

            // Format angka menjadi ribuan untuk input "Total"
            totalInput.value = 'Rp. ' + total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    </script>
    <script>
        $(document).ready(function() {
            // Menampilkan modal edit ketika tombol "Ubah" diklik
            $('.btn-edit').click(function() {
                var rabId = $(this).data('id');
                $('#ModalEdit' + rabId).modal('show');
                // Ambil selectbox Klasifikasi
                var classificationSelect = $('#classificationED' + rabId);
                // Ambil selectbox Rincian
                var detailSelect = $('#detailED' + rabId);
                // Ambil selectbox Komponen
                var componentSelect = $('#componentED' + rabId);
                // Ambil selectbox Klasifikasi
                var groupSelect = $('#groupED' + rabId);
                // Ambil selectbox Rincian
                var typeSelect = $('#typeED' + rabId);

                // Ketika selectbox Kegiatan berubah
                $('#activityED' + rabId).change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                    classificationSelect.empty().append(
                        '<option value="">Pilih Klasifikasi</option>');
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    detailSelect.empty().append('<option value="">Pilih Rincian</option>');
                    // Reset dan hapus opsi yang ada pada selectbox Komponen
                    componentSelect.empty().append('<option value="">Pilih Komponen</option>');

                    var selectedActivityId = $(this).val();
                    if (selectedActivityId) {
                        // Ambil data klasifikasi berdasarkan kegiatan yang dipilih
                        $.ajax({
                            url: '/get-classifications/' +
                                selectedActivityId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Isi selectbox Klasifikasi dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    classificationSelect.append('<option value="' +
                                        data[i].id +
                                        '">' + data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });

                // Ketika selectbox Klasifikasi berubah
                classificationSelect.change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    detailSelect.empty().append('<option value="">Pilih Rincian</option>');
                    // Reset dan hapus opsi yang ada pada selectbox Komponen
                    componentSelect.empty().append('<option value="">Pilih Komponen</option>');

                    var selectedClassificationId = $(this).val();
                    if (selectedClassificationId) {
                        // Ambil data rincian berdasarkan klasifikasi yang dipilih
                        $.ajax({
                            url: '/get-details/' +
                                selectedClassificationId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            success: function(data) {
                                // Isi selectbox Rincian dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    detailSelect.append('<option value="' + data[i].id +
                                        '">' +
                                        data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });

                // Ketika selectbox Rincian berubah
                detailSelect.change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Komponen
                    componentSelect.empty().append('<option value="">Pilih Komponen</option>');

                    var selectedDetailId = $(this).val();
                    if (selectedDetailId) {
                        // Ambil data komponen berdasarkan rincian yang dipilih
                        $.ajax({
                            url: '/get-components/' +
                                selectedDetailId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            success: function(data) {
                                // Isi selectbox Komponen dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    componentSelect.append('<option value="' + data[i]
                                        .id + '">' +
                                        data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });

                // Ketika selectbox Kegiatan berubah
                $('#resourceED' + rabId).change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                    groupSelect.empty().append('<option value="">Pilih Kelompok Akun</option>');
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    typeSelect.empty().append('<option value="">Pilih Akun</option>');

                    var selectedResourceId = $(this).val();
                    if (selectedResourceId) {
                        // Ambil data klasifikasi berdasarkan kegiatan yang dipilih
                        $.ajax({
                            url: '/get-groups/' +
                                selectedResourceId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Isi selectbox Klasifikasi dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    groupSelect.append('<option value="' + data[i].id +
                                        '">' + data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });

                // Ketika selectbox Klasifikasi berubah
                groupSelect.change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    typeSelect.empty().append('<option value="">Pilih Akun</option>');

                    var selectedgroupId = $(this).val();
                    if (selectedgroupId) {
                        // Ambil data rincian berdasarkan klasifikasi yang dipilih
                        $.ajax({
                            url: '/get-types/' +
                                selectedgroupId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            success: function(data) {
                                // Isi selectbox Rincian dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    typeSelect.append('<option value="' + data[i].id +
                                        '">' +
                                        data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Menampilkan modal edit ketika tombol "Ubah" diklik
            $('.btn-verifikasi').click(function() {
                var rabId = $(this).data('id');
                $('#ModalVerifikasi' + rabId).modal('show');
            });

            // Fungsi untuk mengatur status dan mengirim form
            function setStatus(status, rabId) {
                document.getElementById('status' + rabId).value = status;
                document.getElementById('myForm' + rabId).submit();
            }

            // Mengikat fungsi setStatus ke tombol "Terima" dan "Tolak"
            $('.btn-terima').click(function() {
                var rabId = $(this).data('id');
                setStatus('DITERIMA', rabId);
            });

            $('.btn-tolak').click(function() {
                var rabId = $(this).data('id');
                setStatus('DITOLAK', rabId);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("table[id^='table-']").each(function() {
                $(this).dataTable({
                    "columnDefs": [{
                        "sortable": false,
                        "targets": [5]
                    }]
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Ambil selectbox Klasifikasi
            var classificationSelect = $('#classificationTD');
            // Ambil selectbox Rincian
            var detailSelect = $('#detailTD');
            // Ambil selectbox Komponen
            var componentSelect = $('#componentTD');
            // Ambil selectbox Sub Komponen
            var sub_componentSelect = $('#sub_componentTD');
            // Ambil selectbox Klasifikasi
            var groupSelect = $('#groupTD');
            // Ambil selectbox Rincian
            var typeSelect = $('#typeTD');

            // Ketika selectbox Kegiatan berubah
            $('#activityTD').change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                classificationSelect.empty().append('<option value="">Pilih Klasifikasi</option>');
                // Reset dan hapus opsi yang ada pada selectbox Rincian
                detailSelect.empty().append('<option value="">Pilih Rincian</option>');
                // Reset dan hapus opsi yang ada pada selectbox Komponen
                componentSelect.empty().append('<option value="">Pilih Komponen</option>');
                // Reset dan hapus opsi yang ada pada selectbox Sub Komponen
                sub_componentSelect.empty().append('<option value="">Pilih Sub Komponen</option>');

                var selectedActivityId = $(this).val();
                if (selectedActivityId) {
                    // Ambil data klasifikasi berdasarkan kegiatan yang dipilih
                    $.ajax({
                        url: '/get-classifications/' +
                            selectedActivityId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Isi selectbox Klasifikasi dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                classificationSelect.append('<option value="' + data[i].id +
                                    '">' +
                                    data[i].code + ' - ' + data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            // Ketika selectbox Klasifikasi berubah
            classificationSelect.change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Rincian
                detailSelect.empty().append('<option value="">Pilih Rincian</option>');
                // Reset dan hapus opsi yang ada pada selectbox Komponen
                componentSelect.empty().append('<option value="">Pilih Komponen</option>');

                var selectedClassificationId = $(this).val();
                if (selectedClassificationId) {
                    // Ambil data rincian berdasarkan klasifikasi yang dipilih
                    $.ajax({
                        url: '/get-details/' +
                            selectedClassificationId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        success: function(data) {
                            // Isi selectbox Rincian dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                detailSelect.append('<option value="' + data[i].id + '">' +
                                    data[i].code + ' - ' +
                                    data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            // Ketika selectbox Rincian berubah
            detailSelect.change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Komponen
                componentSelect.empty().append('<option value="">Pilih Komponen</option>');

                var selectedDetailId = $(this).val();
                if (selectedDetailId) {
                    // Ambil data komponen berdasarkan rincian yang dipilih
                    $.ajax({
                        url: '/get-components/' +
                            selectedDetailId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        success: function(data) {
                            // Isi selectbox Komponen dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                componentSelect.append('<option value="' + data[i].id + '">' +
                                    data[i].code + ' - ' +
                                    data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            // Ketika selectbox Komponen berubah
            componentSelect.change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Sub Komponen
                sub_componentSelect.empty().append('<option value="">Pilih Sub Komponen</option>');

                var selectedComponentId = $(this).val();
                if (selectedComponentId) {
                    // Ambil data sub komponen berdasarkan komponen yang dipilih
                    $.ajax({
                        url: '/get-sub-components/' +
                            selectedComponentId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        success: function(data) {
                            // Isi selectbox Sub Komponen dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                sub_componentSelect.append('<option value="' + data[i].id +
                                    '">' + data[i].code + ' - ' +
                                    data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            // Ketika selectbox Kegiatan berubah
            $('#resourceTD').change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                groupSelect.empty().append('<option value="">Pilih Kelompok Akun</option>');
                // Reset dan hapus opsi yang ada pada selectbox Rincian
                typeSelect.empty().append('<option value="">Pilih Akun</option>');

                var selectedResourceId = $(this).val();
                if (selectedResourceId) {
                    // Ambil data klasifikasi berdasarkan kegiatan yang dipilih
                    $.ajax({
                        url: '/get-groups/' +
                            selectedResourceId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            // Isi selectbox Klasifikasi dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                groupSelect.append('<option value="' + data[i].id +
                                    '">' + data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            // Ketika selectbox Klasifikasi berubah
            groupSelect.change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Rincian
                typeSelect.empty().append('<option value="">Pilih Akun</option>');

                var selectedgroupId = $(this).val();
                if (selectedgroupId) {
                    // Ambil data rincian berdasarkan klasifikasi yang dipilih
                    $.ajax({
                        url: '/get-types/' +
                            selectedgroupId, // Ganti URL ini sesuai kebutuhan
                        type: 'GET',
                        success: function(data) {
                            // Isi selectbox Rincian dengan data yang diterima
                            for (var i = 0; i < data.length; i++) {
                                typeSelect.append('<option value="' + data[i].id + '">' +
                                    data[i].name + '</option>');
                            }
                        }
                    });
                }
            });

            $('.btn-add').click(function() {
                var Id = $(this).data('id');
                // Ambil selectbox Klasifikasi
                var groupSelect = $('#groupTD' + Id);
                // Ambil selectbox Rincian
                var typeSelect = $('#typeTD' + Id);

                // Ketika selectbox Kegiatan berubah
                $('#resourceTD' + Id).change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                    groupSelect.empty().append('<option value="">Pilih Kelompok Akun</option>');
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    typeSelect.empty().append('<option value="">Pilih Akun</option>');

                    var selectedResourceId = $(this).val();
                    if (selectedResourceId) {
                        // Ambil data klasifikasi berdasarkan kegiatan yang dipilih
                        $.ajax({
                            url: '/get-groups/' +
                                selectedResourceId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Isi selectbox Klasifikasi dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    groupSelect.append('<option value="' + data[i].id +
                                        '">' + data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });

                // Ketika selectbox Klasifikasi berubah
                groupSelect.change(function() {
                    // Reset dan hapus opsi yang ada pada selectbox Rincian
                    typeSelect.empty().append('<option value="">Pilih Akun</option>');

                    var selectedgroupId = $(this).val();
                    if (selectedgroupId) {
                        // Ambil data rincian berdasarkan klasifikasi yang dipilih
                        $.ajax({
                            url: '/get-types/' +
                                selectedgroupId, // Ganti URL ini sesuai kebutuhan
                            type: 'GET',
                            success: function(data) {
                                // Isi selectbox Rincian dengan data yang diterima
                                for (var i = 0; i < data.length; i++) {
                                    typeSelect.append('<option value="' + data[i].id +
                                        '">' +
                                        data[i].name + '</option>');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        var table = document.getElementById("tabelRAB1");
        var tbody = table.querySelector('tbody');
        var rowNumber = 2; // Inisialisasi nomor baris

        // Fungsi untuk menambahkan baris baru
        function addRow() {
            var newRow = document.createElement('tr');
            newRow.innerHTML =
                '<th scope="row">' + rowNumber++ + '</th>' +
                '<td><textarea name="" id="" cols="30" rows="3" oninput="addRowIfNotEmpty(this)"></textarea></td>' +
                '<td><input type="number" class="form-control" id="volume" name="volume" placeholder="0"></td>' +
                '<td><input type="text" class="form-control" id="unit" name="unit" placeholder="0"></td>' +
                '<td><input type="text" class="form-control currency" id="frequency" name="frequency"></td>' +
                '<td><input type="text" class="form-control currency" id="price" name="price" placeholder="Rp. 0" readonly></td>';
            tbody.appendChild(newRow);
        }

        // Fungsi untuk menambahkan baris jika input tidak kosong
        function addRowIfNotEmpty(input) {
            var lastRow = tbody.lastElementChild;
            if (input.value.trim() !== "") {
                if (input.parentElement.parentElement === lastRow) {
                    addRow();
                }
            }
        }
    </script>
@endpush
