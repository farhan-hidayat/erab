@extends('layouts.dashboard')

@section('title')
    E-RAB | Fakultas
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Fakultas</h1>
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
                            {{-- <div class="card-header">
                                <h4>Data Fakultas</h4>
                            </div> --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama</th>
                                                <th>Slug</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1
                                                </td>
                                                <td>Fakultas Teknik</td>
                                                <td>fakultas-teknik</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Ubah</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2
                                                </td>
                                                <td>Fakultas Ekonomi dan Bisnis</td>
                                                <td>fakultas-ekonomi-dan-bisnis</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Ubah</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3
                                                </td>
                                                <td>Fakultas Kedokteran</td>
                                                <td>fakultas-kedokteran</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Ubah</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4
                                                </td>
                                                <td>Fakultas Ilmu Sosial dan Ilmu Politik</td>
                                                <td>fakultas-ilmu-sosial-dan-ilmu-politik</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Ubah</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    5
                                                </td>
                                                <td>Fakultas Matematika dan Ilmu Pengetahuan Alam</td>
                                                <td>fakultas-matematika-dan-ilmu-pengetahuan-alam</td>
                                                <td>
                                                    <a href="#" class="btn btn-primary">Ubah</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
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
@endsection

@push('prepend-script')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
@endpush
@push('addon-script')
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
