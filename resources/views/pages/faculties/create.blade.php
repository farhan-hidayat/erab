@extends('layouts.dashboard')

@section('title')
    E-RAB | Tambah Fakultas
@endsection

@push('prepend-style')
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('faculties.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Data Fakultas</h1>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="col-6">

                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Fakultas</h4>
                                </div>
                                <form action="{{ route('faculties.store') }}" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Nama Fakultas</label>
                                            <input id="name" type="text" class="form-control" name="name"
                                                required>
                                            {{-- @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror --}}
                                        </div>
                                        <div class="text-right col">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
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
@endpush
@push('addon-script')
@endpush
