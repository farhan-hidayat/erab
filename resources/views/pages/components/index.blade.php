@extends('layouts.dashboard')

@section('title')
    E-RAB | Komponen
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/selectric/public/selectric.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Komponen</h1>
                <div class="section-header-button">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah"> <i
                            class="fa-solid fa-plus"></i> Tambah
                        Komponen </a>
                </div>
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
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Kode</th>
                                                <th>Rincian</th>
                                                <th>Nama</th>
                                                <th>Slug</th>
                                                <th width="20%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($components as $component)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $component->code }}
                                                    </td>
                                                    <td>{{ $component->detail->name }}</td>
                                                    <td>{{ $component->name }}</td>
                                                    <td>{{ $component->slug }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-edit"
                                                            data-toggle="modal" data-target="#ModalEdit{{ $component->id }}"
                                                            data-id="{{ $component->id }}"><i class="fas fa-edit"></i>
                                                            Ubah</a>
                                                        <a href="{{ route('components.destroy', $component->id) }}"
                                                            class="btn btn-danger" data-confirm-delete="true"><i
                                                                class="fas fa-trash"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('pages.components.modals')
@endsection

@push('prepend-script')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    <script src="/node_modules/selectric/public/jquery.selectric.min.js"></script>
@endpush
@push('addon-script')
    <script>
        $(document).ready(function() {
            // Menampilkan modal edit ketika tombol "Ubah" diklik
            $('.btn-edit').click(function() {
                var componentId = $(this).data('id');
                $('#ModalEdit' + componentId).modal('show');
                $('#classificationedit' + componentId).change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var frontCode = selectedOption.data('front-code-edit');
                    $('#front_code_edit' + componentId).val(frontCode);
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#detail').change(function() {
                var selectedOption = $(this).find('option:selected');
                var frontCode = selectedOption.data('front-code');
                $('#front_code').val(frontCode);
            });
        });
    </script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
