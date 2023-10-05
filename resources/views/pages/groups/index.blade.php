@extends('layouts.dashboard')

@section('title')
    E-RAB | Grup
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
                <h1>Data Grup</h1>
                <div class="section-header-button">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah"> <i
                            class="fa-solid fa-plus"></i> Tambah
                        Grup </a>
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
                                                <th>Sumber Dana</th>
                                                <th>Nama</th>
                                                <th>Slug</th>
                                                {{-- <th>Rincian</th> --}}
                                                <th width="20%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groups as $group)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $group->code }}
                                                    </td>
                                                    <td>{{ $group->resource->name }}</td>
                                                    <td>{{ $group->name }}</td>
                                                    <td>{{ $group->slug }}</td>
                                                    {{-- <td><a href="#" class="btn btn-success btn-add"
                                                            data-toggle="modal"
                                                            data-target="#ModalAdd{{ $group->id }}"
                                                            data-id="{{ $group->id }}"><i
                                                                class="fas fa-plus"></i><span
                                                                class="badge badge-transparent">{{ $group->details_count }}</span></a>
                                                    </td> --}}
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-edit"
                                                            data-toggle="modal" data-target="#ModalEdit{{ $group->id }}"
                                                            data-id="{{ $group->id }}"><i class="fas fa-edit"></i>
                                                            Ubah</a>
                                                        <a href="{{ route('groups.destroy', $group->id) }}"
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

    @include('pages.groups.modals')
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
                var groupId = $(this).data('id');
                $('#ModalEdit' + groupId).modal('show');
                $('#resourceedit' + groupId).change(function() {
                    var selectedOption = $(this).find('option:selected');
                    var frontCode = selectedOption.data('front-code-edit');
                    $('#front_code_edit' + groupId).val(frontCode);
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#resource').change(function() {
                var selectedOption = $(this).find('option:selected');
                var frontCode = selectedOption.data('front-code');
                $('#front_code').val(frontCode);
            });
        });
    </script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
