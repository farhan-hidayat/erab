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
                                            @if (Auth::user()->roles == 'USER')
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($rabs->where('user_id', Auth::user()->id) as $rab)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $rab->ticket }}</td>
                                                        <td>{{ $rab->user->faculty->name }}</td>
                                                        <td>Rp. {{ number_format($rab->price) }}</td>
                                                        <td>Rp. {{ number_format($rab->balance) }}</td>
                                                        <td class="text-center">
                                                            <a href="#" class="btn btn-primary btn-lihat"
                                                                data-toggle="modal"
                                                                data-target="#ModalLihat{{ $rab->id }}"
                                                                data-id="{{ $rab->id }}"><i class="fas fa-eye"></i>
                                                                Lihat</a>
                                                            <a href="#" class="btn btn-success btn-tarik"
                                                                data-toggle="modal"
                                                                data-target="#ModalTarik{{ $rab->id }}"
                                                                data-id="{{ $rab->id }}"><i
                                                                    class="fa-solid fa-money-bill-1-wave"></i>
                                                                Pencairan</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @php
                                                    $no = 1;
                                                @endphp
                                                @foreach ($rabs as $rab)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $rab->ticket }}</td>
                                                        <td>{{ $rab->user->faculty->name }}</td>
                                                        <td>Rp. {{ number_format($rab->price) }}</td>
                                                        <td>Rp. {{ number_format($rab->balance) }}</td>
                                                        <td class="text-center">
                                                            <a href="#" class="btn btn-primary btn-lihat"
                                                                data-toggle="modal"
                                                                data-target="#ModalLihat{{ $rab->id }}"
                                                                data-id="{{ $rab->id }}"><i class="fas fa-eye"></i>
                                                                Lihat</a>
                                                            {{-- <a href="#" class="btn btn-success btn-tarik"
                                                                data-toggle="modal" data-target="#ModalTarik"
                                                                data-id="{{ $rab->id }}"><i
                                                                    class="fa-solid fa-money-bill-1-wave"></i>
                                                                Pencairan</a> --}}
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
            $('.btn-lihat').click(function() {
                var rabId = $(this).data('id');
                $('#ModaLihat' + rabId).modal('show');

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
            $('.btn-tarik').click(function() {
                var rabId = $(this).data('id');
                $('#ModaTarik' + rabId).modal('show');

                const rabPriceInput = document.querySelector('#rab_price' + rabId);
                const rabBalanceInput = document.querySelector('#rab_balance' + rabId);
                const currencyInputs = document.querySelectorAll('.currency' + rabId);

                // Simpan nilai awal dari rab_balance untuk mengembalikannya jika input dihapus
                const initialBalance = parseInt(rabBalanceInput.value.replace(/[^0-9]/g, ''));

                currencyInputs.forEach(function(input) {
                    input.addEventListener('input', function() {
                        // Menghapus karakter selain angka
                        let value = this.value.replace(/[^0-9]/g, '');

                        // Format angka menjadi ribuan
                        if (value.length > 3) {
                            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }

                        // Setel nilai input dengan format ribuan
                        this.value = value;

                        // Perbarui rab_balance secara dinamis
                        const priceValue = parseInt(value.replace(/,/g,
                            '')); // Hapus tanda koma dan parse ke integer
                        if (!isNaN(priceValue)) {
                            // Hitung ulang saldo dari awal berdasarkan semua input yang ada
                            let newBalance = initialBalance;

                            currencyInputs.forEach(function(otherInput) {
                                if (otherInput !== input) {
                                    const otherValue = otherInput.value.replace(
                                        /[^0-9]/g, '');
                                    const otherPriceValue = parseInt(otherValue);

                                    if (!isNaN(otherPriceValue)) {
                                        newBalance -= otherPriceValue;
                                    }
                                }
                            });

                            // Periksa apakah nilai input melebihi saldo
                            if (priceValue > newBalance) {
                                // Pesan kesalahan jika nilai input melebihi saldo
                                this.value = 0;
                                rabBalanceInput.value = 'Rp. ' + initialBalance
                                    .toLocaleString();
                            } else {
                                // Update saldo jika nilai input tidak melebihi saldo
                                newBalance -= priceValue;
                                rabBalanceInput.value = 'Rp. ' + newBalance
                                    .toLocaleString();
                            }

                            // // Periksa apakah nilai input melebihi 50% dari rab_price
                            // const rabPriceValue = parseInt(rabPriceInput.value.replace(
                            //     /[^0-9]/g, ''));
                            // if (priceValue > rabPriceValue * 0.5) {
                            //     // Pesan kesalahan jika nilai input melebihi 50% dari rab_price
                            //     this.value = (rabPriceValue * 0.5).toLocaleString();
                            // } else if (priceValue > newBalance) {
                            //     // Pesan kesalahan jika nilai input melebihi saldo
                            //     this.value = 0;
                            //     rabBalanceInput.value = 'Rp. ' + initialBalance
                            //         .toLocaleString();
                            // } else {
                            //     // Update saldo jika nilai input tidak melebihi saldo
                            //     newBalance -= priceValue;
                            //     rabBalanceInput.value = 'Rp. ' + newBalance
                            // .toLocaleString();
                            // }
                        }
                    });
                    // Tangani peristiwa ketika input dihapus
                    input.addEventListener('keyup', function(event) {
                        if (event.key === 'Backspace' || event.key === 'Delete') {
                            rabBalanceInput.value = 'Rp. ' + initialBalance
                                .toLocaleString(); // Kembalikan ke nilai awal
                        }
                    });
                });
            });
        });
    </script>
    <script src="/assets/js/page/modules-datatables.js"></script>
@endpush
