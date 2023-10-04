@extends('layouts.dashboard')

@section('title')
    E-RAB | Pengguna
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Pengguna</h1>
                <div class="section-header-button">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#ModalTambah"> <i
                            class="fa-solid fa-plus"></i> Tambah
                        Pengguna </a>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills justify-content-center" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                            role="tab" aria-controls="home" aria-selected="true">Pengguna Fakultas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                            role="tab" aria-controls="profile" aria-selected="false">Admin</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-user">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Nama</th>
                                                        <th>Fakultas</th>
                                                        <th>email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->faculty->name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-edit"
                                                                    data-toggle="modal"
                                                                    data-target="#ModalEditUser{{ $user->id }}"><i
                                                                        class="fas fa-edit"></i> Ubah</a>
                                                                <a href="{{ route('users.destroy', $user->id) }}"
                                                                    class="btn btn-danger" data-confirm-delete="true"><i
                                                                        class="fas fa-trash"></i> Hapus</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-admin">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Nama</th>
                                                        <th>email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $noo = 1;
                                                    @endphp
                                                    @foreach ($admins as $admin)
                                                        <tr>
                                                            <td>{{ $noo++ }}</td>
                                                            <td>{{ $admin->name }}</td>
                                                            <td>{{ $admin->email }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary btn-edit"
                                                                    data-toggle="modal"
                                                                    data-target="#ModalEditAdmin{{ $admin->id }}"
                                                                    data-id="{{ $admin->id }}"><i
                                                                        class="fas fa-edit"></i> Ubah</a>
                                                                <a href="{{ route('users.destroy', $admin->id) }}"
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
                </div>
            </div>
        </section>
    </div>

    @include('pages.users.modals')
@endsection

@push('prepend-script')
    <script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
@endpush
@push('addon-script')
    <script>
        $("#table-user").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [4]
            }]
        });
        $("#table-admin").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [3]
            }]
        });
    </script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
