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
                        <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Data RAB</h4>
                            </div>
                            <div class="card-body">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Klasifikasi</span>
                                            </div>
                                            <select name="classification_id" id="classificationTD" class="form-control">
                                                <option value="">Pilih Kegiatan</option>
                                                @foreach ($classifications as $classification)
                                                <option value="{{ $classification->id }}">
                                                    {{ $classification->code }} -
                                                    {{ $classification->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rincian</span>
                                            </div>
                                            <select name="detail_id" id="detailTD" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">

                                            <div class="input-group-append">
                                                <span class="input-group-text">Komponen</span>
                                            </div>
                                            <select name="component_id" id="componentTD" class="form-control">
                                            </select>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Sub Komponen</span>
                                            </div>
                                            <select name="sub_component_id" id="sub_componentTD" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">

                                            <div class="input-group-append">
                                                <span class="input-group-text">Sumber Dana</span>
                                            </div>
                                            <select name="type_id" class="form-control">
                                                <option value="">Pilih Sumber</option>
                                                @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->code }} -
                                                    {{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col" width="15%">Volume</th>
                                                <th scope="col" width="15%">Satuan</th>
                                                <th scope="col" width="18%">Harga</th>
                                                <th scope="col" width="20%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <textarea name="description" id="description" cols="30" rows="3"
                                                        style="border: none;"></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" id="volume" name="volume"
                                                        placeholder="0">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="unit" name="unit">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control currency" id="price"
                                                        name="price">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control currency" id="total"
                                                        name="total" placeholder="Rp. 0" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('rabs.store') }} " method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="5%">#</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Volume</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 1;
                                        $totalKeseluruhan = 0;
                                        $currentSubComponent = null;
                                        $currentType = null;
                                        @endphp

                                        @foreach ($rab_requests as $rab_request)
                                        @if ($currentSubComponent !== $rab_request->sub_component->id)
                                        <tr>
                                            <th colspan="7">
                                                {{ $rab_request->sub_component->code }}-{{
                                                $rab_request->sub_component->name }}
                                            </th>
                                            @php
                                            $currentSubComponent = $rab_request->sub_component->id;
                                            $currentType = null; // Reset currentType when sub_component changes
                                            $no = 1; // Reset $no when sub_component changes
                                            @endphp
                                        </tr>
                                        @endif

                                        @if ($currentType !== $rab_request->type->id)
                                        <tr>
                                            <th colspan="7">
                                                {{ $rab_request->type->code }}-{{ $rab_request->type->name }}
                                            </th>
                                            @php
                                            $currentType = $rab_request->type->id;
                                            $no = 1; // Reset $no when type changes
                                            @endphp
                                        </tr>
                                        @endif

                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>
                                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="3"
                                                    style="border: none;"
                                                    disabled>{{ $rab_request->description }}</textarea>
                                            </td>
                                            <td>{{ $rab_request->volume }}
                                            </td>
                                            <td>{{ $rab_request->unit }}
                                            </td>
                                            <td>Rp. {{ number_format($rab_request->price) }}
                                            </td>
                                            <td>Rp. {{ number_format($rab_request->total) }}
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-edit" data-toggle="modal"
                                                    data-target="#ModalEdit{{ $rab_request->id }}"
                                                    data-id="{{ $rab_request->id }}"><i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('requests.destroy', $rab_request->id) }}"
                                                    class="btn btn-danger" data-confirm-delete="true"><i
                                                        class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        @php
                                        $totalKeseluruhan += $rab_request->total;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total Keseluruhan</th>
                                            <th colspan="3">Rp. {{ number_format($totalKeseluruhan) }}</th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="totalKeseluruhan" value="{{ $totalKeseluruhan }}">
                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-paper-plane"></i>
                                    Ajukan RAB</button>
                                <a href="{{ route('rabs.index') }}" class="btn btn-secondary"><i
                                        class="fa-solid fa-floppy-disk"></i>
                                    Draft</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('pages.rabs.modals')
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

                const volumeInput = document.getElementById('volume' + rabId);
                const priceInput = document.getElementById('price' + rabId);
                const totalInput = document.getElementById('total' + rabId);

                const currencyInputs = document.querySelectorAll('.currency' + rabId);

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
@endpush