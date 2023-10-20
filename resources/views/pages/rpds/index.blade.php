@extends('layouts.dashboard')

@section('title')
    E-RAB | RPD
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data RPD</h1>
                {{-- <div class="section-header-button">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah"> <i
                            class="fa-solid fa-plus"></i> Tambah
                        Sumber Dana </a>
                </div> --}}
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
                                                <th class="text-center" width="5%">
                                                    #
                                                </th>
                                                <th>Tiket</th>
                                                <th>Fakultas</th>
                                                <th>Total</th>
                                                <th>Sisa</th>
                                                <th width="20%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($resources as $resource) --}}
                                            <tr>
                                                <td>1</td>
                                                <td>RAB-20231010</td>
                                                <td>Fakultas Teknik</td>
                                                <td>Rp. 1,500,000</td>
                                                <td>Rp. 1,000,000</td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-lihat" data-toggle="modal"
                                                        data-target="#ModalLihat" data-id="#"><i class="fas fa-eye"></i>
                                                        Lihat</a>
                                                    <a href="#" class="btn btn-success btn-tarik" data-toggle="modal"
                                                        data-target="#ModalTarik" data-id="#"><i
                                                            class="fa-solid fa-money-bill-1-wave"></i> Pencairan</a>
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
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

    @include('pages.rpds.modals')
@endsection

@push('prepend-script')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
@endpush
@push('addon-script')
    <script>
        $(document).ready(function() {
            // Menampilkan modal edit ketika tombol "Ubah" diklik
            $('.btn-edit').click(function() {
                var resourceId = $(this).data('id');
                $('#ModalEdit' + resourceId).modal('show');
            });
        });
    </script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
