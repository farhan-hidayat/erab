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
                <h1>Data RAB</h1>
                @if (Auth::user()->roles == 'USER')
                    <div class="section-header-button">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah"> <i
                                class="fa-solid fa-plus"></i> Ajukan RAB </a>
                    </div>
                @endif
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
                                {{-- Data Kegiatan --}}
                                <div id="accordion">
                                    @foreach ($activities as $activity)
                                        <div class="accordion">
                                            <div class="accordion-header" role="button" data-toggle="collapse"
                                                data-target="#panel-body-{{ $activity->code }}">
                                                <h4>{{ $activity->code }} - {{ $activity->name }}</h4>
                                            </div>
                                            <div class="accordion-body collapse" id="panel-body-{{ $activity->code }}"
                                                data-parent="#accordion">
                                                {{-- Data Klasifikasi --}}
                                                <div id="accordion-{{ $activity->code }}">
                                                    @foreach ($activity->classifications as $classification)
                                                        <div class="accordion">
                                                            <div class="accordion-header" role="button"
                                                                data-toggle="collapse"
                                                                data-target="#panel-body-{{ $classification->slug }}">
                                                                <h4>{{ $classification->code }} -
                                                                    {{ $classification->name }}</h4>
                                                            </div>
                                                            <div class="accordion-body collapse"
                                                                id="panel-body-{{ $classification->slug }}"
                                                                data-parent="#accordion-{{ $activity->code }}">
                                                                {{-- Data Rincian --}}
                                                                <div id="accordion-{{ $classification->slug }}">
                                                                    @foreach ($classification->details as $detail)
                                                                        <div class="accordion">
                                                                            <div class="accordion-header" role="button"
                                                                                data-toggle="collapse"
                                                                                data-target="#panel-body-{{ $detail->slug }}">
                                                                                <h4>{{ $detail->code }} -
                                                                                    {{ $detail->name }}</h4>
                                                                            </div>
                                                                            <div class="accordion-body collapse"
                                                                                id="panel-body-{{ $detail->slug }}"
                                                                                data-parent="#accordion-{{ $classification->slug }}">
                                                                                {{-- Data Komponen --}}
                                                                                <div id="accordion-{{ $detail->slug }}">
                                                                                    @foreach ($detail->components as $component)
                                                                                        <div class="accordion">
                                                                                            <div class="accordion-header d-flex justify-content-between"
                                                                                                role="button"
                                                                                                data-toggle="collapse"
                                                                                                data-target="#panel-body-{{ $component->slug }}">
                                                                                                <h4>{{ $component->code }}
                                                                                                    -
                                                                                                    {{ $component->name }}
                                                                                                </h4>
                                                                                                @if (Auth::user()->roles == 'USER')
                                                                                                    <a href="#"
                                                                                                        class="btn btn-success btn-add"
                                                                                                        data-toggle="modal"
                                                                                                        data-target="#ModalAdd{{ $component->id }}"
                                                                                                        data-id="{{ $component->id }}"><i
                                                                                                            class="fas fa-plus"></i>
                                                                                                        {{-- <span
                                                                                                                    class="badge badge-transparent">{{ $activity->classifications_count }}</span> --}}
                                                                                                    </a>
                                                                                                @endif
                                                                                            </div>
                                                                                            <div class="accordion-body collapse"
                                                                                                id="panel-body-{{ $component->slug }}"
                                                                                                data-parent="#accordion-{{ $detail->slug }}">
                                                                                                <div class="card">
                                                                                                    <div class="card-body">
                                                                                                        <div
                                                                                                            class="table-responsive">
                                                                                                            <table
                                                                                                                class="table table-striped"
                                                                                                                id="table-{{ $component->id }}">
                                                                                                                <thead>
                                                                                                                    <tr>
                                                                                                                        <th
                                                                                                                            class="text-center">
                                                                                                                            #
                                                                                                                        </th>
                                                                                                                        <th>Tiket
                                                                                                                        </th>
                                                                                                                        <th>Akun
                                                                                                                        </th>
                                                                                                                        <th>Nominal
                                                                                                                        </th>
                                                                                                                        <th>Status
                                                                                                                        </th>
                                                                                                                        <th width="20%"
                                                                                                                            class="text-center">
                                                                                                                            Aksi
                                                                                                                        </th>
                                                                                                                    </tr>
                                                                                                                </thead>
                                                                                                                <tbody>
                                                                                                                    @if (Auth::user()->roles == 'USER')
                                                                                                                        @foreach ($rabs->where('component_id', $component->id)->where('user_id', Auth::user()->id) as $rab)
                                                                                                                            <tr>
                                                                                                                                <td>{{ $no++ }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->ticket }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->type->name }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->price }}
                                                                                                                                </td>
                                                                                                                                <td>
                                                                                                                                    @if ($rab->status == 'PENGAJUAN')
                                                                                                                                        <span
                                                                                                                                            class="badge badge-warning">Pengajuan</span>
                                                                                                                                    @elseif($rab->status == 'DITOLAK')
                                                                                                                                        <span
                                                                                                                                            class="badge badge-danger">Ditolak</span>
                                                                                                                                    @else
                                                                                                                                        <span
                                                                                                                                            class="badge badge-success">Diterima</span>
                                                                                                                                    @endif
                                                                                                                                </td>
                                                                                                                                <td>
                                                                                                                                    @if (Auth::user()->roles == 'USER')
                                                                                                                                        <a href="#"
                                                                                                                                            class="btn btn-primary btn-edit"
                                                                                                                                            data-toggle="modal"
                                                                                                                                            data-target="#"
                                                                                                                                            data-id="#"><i
                                                                                                                                                class="fas fa-edit"></i>
                                                                                                                                            Ubah</a>
                                                                                                                                    @endif
                                                                                                                                    <a href="#"
                                                                                                                                        class="btn btn-danger"
                                                                                                                                        data-confirm-delete="true"><i
                                                                                                                                            class="fas fa-trash"></i>
                                                                                                                                        Hapus</a>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        @endforeach
                                                                                                                    @else
                                                                                                                        @foreach ($rabs->where('component_id', $component->id) as $rab)
                                                                                                                            <tr>
                                                                                                                                <td>{{ $no++ }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->ticket }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->type->name }}
                                                                                                                                </td>
                                                                                                                                <td>{{ $rab->price }}
                                                                                                                                </td>
                                                                                                                                <td>
                                                                                                                                    @if ($rab->status == 'PENGAJUAN')
                                                                                                                                        <span
                                                                                                                                            class="badge badge-warning">Pengajuan</span>
                                                                                                                                    @elseif($rab->status == 'DITOLAK')
                                                                                                                                        <span
                                                                                                                                            class="badge badge-danger">Ditolak</span>
                                                                                                                                    @else
                                                                                                                                        <span
                                                                                                                                            class="badge badge-success">Diterima</span>
                                                                                                                                    @endif
                                                                                                                                </td>
                                                                                                                                <td>
                                                                                                                                    @if (Auth::user()->roles == 'USER')
                                                                                                                                        <a href="#"
                                                                                                                                            class="btn btn-primary btn-edit"
                                                                                                                                            data-toggle="modal"
                                                                                                                                            data-target="#"
                                                                                                                                            data-id="#"><i
                                                                                                                                                class="fas fa-edit"></i>
                                                                                                                                            Ubah</a>
                                                                                                                                    @endif
                                                                                                                                    <a href="#"
                                                                                                                                        class="btn btn-danger"
                                                                                                                                        data-confirm-delete="true"><i
                                                                                                                                            class="fas fa-trash"></i>
                                                                                                                                        Hapus</a>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        @endforeach
                                                                                                                    @endif
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('pages.rabs.modals')
@endsection

@push('prepend-script')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="/node_modules/summernote/dist/summernote-bs4.js"></script>
@endpush
@push('addon-script')
    <script>
        $(document).ready(function() {
            // Menampilkan modal edit ketika tombol "Ubah" diklik
            $('.btn-edit').click(function() {
                var activityId = $(this).data('id');
                $('#ModalEdit' + activityId).modal('show');
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

            // Ketika selectbox Kegiatan berubah
            $('#activityTD').change(function() {
                // Reset dan hapus opsi yang ada pada selectbox Klasifikasi
                classificationSelect.empty().append('<option value="">Pilih Klasifikasi</option>');
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
                                classificationSelect.append('<option value="' + data[i].id +
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
                                detailSelect.append('<option value="' + data[i].id + '">' +
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
                                    data[i].name + '</option>');
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Ambil selectbox Klasifikasi
            var groupSelect = $('#groupTD');
            // Ambil selectbox Rincian
            var typeSelect = $('#typeTD');

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
        });
    </script>
    {{-- <script src="/assets/js/page/modules-datatables.js"></script> --}}
@endpush
