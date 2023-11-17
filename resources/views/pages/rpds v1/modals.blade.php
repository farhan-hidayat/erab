<!-- Modal Lihat -->
@foreach ($rabs as $rab)
    <div class="modal fade" id="ModalLihat{{ $rab->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalLihat{{ $rab->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLihat{{ $rab->id }}">Detail RPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form method="POST" action="{{ route('rpds.store') }}" enctype="multipart/form-data">
                    @csrf --}}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tiket RAB</span>
                            </div>
                            <input type="text" class="form-control" id="ticket" name="ticket"
                                value="{{ $rab->ticket }}" disabled>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sub Komponen</span>
                            </div>
                            <input type="text" name="sub_component_id" class="form-control"
                                value="{{ $rab->sub_component->code }}" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text">Akun Dana</span>
                            </div>
                            <input type="text" name="type_id" class="form-control" value="{{ $rab->type->code }}"
                                disabled>
                        </div>
                    </div> --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $rab->user->faculty->name }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="mt-0 section-title">Total RAB : Rp. {{ number_format($rab->price) }}</div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col">Tiket</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Sisa</th>
                                        <th scope="col">Bulan Pencairan</th>
                                        <th scope="col">Status</th>
                                        @if (Auth::user()->roles == 'ADMIN')
                                            <th scope="col">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($rpds->where('rab_id', $rab->id) as $rpd)
                                        <tr>
                                            <th scope="row">{{ $no++ }}</th>
                                            <td>{{ $rpd->ticket }}</td>
                                            <td>Rp. {{ number_format($rpd->price) }}</td>
                                            <td>Rp. {{ number_format($rpd->balance) }}</td>
                                            <td> {{ \Carbon\Carbon::createFromFormat('!m', $rpd->month)->format('F') }}
                                            </td>
                                            <td>
                                                @if ($rpd->status == 'PENGAJUAN')
                                                    <span class="badge badge-warning">Pengajuan</span>
                                                @elseif($rpd->status == 'DITOLAK')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @else
                                                    <span class="badge badge-success">Diterima</span>
                                                @endif
                                            </td>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <td class="text-center">
                                                    <form action="{{ route('rpds.update', $rpd->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input type="hidden" name="status"
                                                                id="status{{ $rpd->id }}" value="">
                                                            <button type="submit" class="btn btn-success btn-terima"
                                                                onclick="setStatus('DITERIMA')"
                                                                data-id="{{ $rpd->id }}"@if ($rpd->status == 'DITERIMA') disabled @endif>Terima</button>
                                                            <button type="submit" class="btn btn-danger btn-tolak"
                                                                onclick="setStatus('DITOLAK')"
                                                                data-id="{{ $rpd->id }}"@if ($rpd->status == 'DITERIMA') disabled @endif>Tolak</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <th scope="row" colspan="6" class="text-center">
                                                    <h1>Belum ada pencairan dana</h1>
                                                </th>
                                            @else
                                                <th scope="row" colspan="5" class="text-center">
                                                    <h1>Belum ada pencairan dana</h1>
                                                </th>
                                            @endif
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary">Tambah</button> --}}
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Pencairan -->
@foreach ($rabs as $rab)
    <div class="modal fade" id="ModalTarik{{ $rab->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalTarik{{ $rab->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalTarik{{ $rab->id }}">Pencairan RPD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('rpds.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tiket RAB</span>
                                </div>
                                <input type="text" class="form-control" id="ticket" name="ticket"
                                    value="{{ $rab->ticket }}" disabled>
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text"></span>
                                </div> --}}
                                <select name="month" class="form-control" id="month" required>
                                    <option value="">- Bulan Pencairan -</option>
                                    @php
                                        $currentYear = now()->year;
                                        $currentMonth = now()->month;
                                    @endphp

                                    @for ($i = $currentMonth; $i <= $currentMonth + (12 - $currentMonth); $i++)
                                        @php
                                            $formattedMonth = date('F', mktime(0, 0, 0, $i, 1));
                                        @endphp
                                        <option value="{{ $i }}">{{ $formattedMonth }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sub Komponen</span>
                                </div>
                                <input type="text" name="sub_component_id" class="form-control"
                                    value="{{ $rab->sub_component->code }}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">Akun Dana</span>
                                </div>
                                <input type="text" name="type_id" class="form-control"
                                    value="{{ $rab->type->code }}" disabled>
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Total RAB</span>
                                </div>
                                <input type="text" name="rab_price" id="rab_price{{ $rab->id }}"
                                    class="form-control rab-price" value="Rp. {{ number_format($rab->price) }}"
                                    disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">Sisa</span>
                                </div>
                                <input type="text" name="rab_balance" id="rab_balance{{ $rab->id }}"
                                    class="form-control rab-balance" value="Rp. {{ number_format($rab->balance) }}"
                                    disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">Cairakan</span>
                                </div>
                                <input type="text" name="price" id="rpd_price{{ $rab->id }}"
                                    class="form-control currency{{ $rab->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="rab_id" value="{{ $rab->id }}">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Modal Ubah -->
{{-- @foreach ($resources as $resource)
    <div class="modal fade" id="ModalEdit{{ $resource->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $resource->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $resource->id }}">Edit Sumber Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('resources.update', $resource->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_code{{ $resource->id }}">Kode</label>
                            <input type="text" class="form-control" id="edit_code{{ $resource->id }}" name="code"
                                value="{{ $resource->code }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $resource->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $resource->id }}" name="name"
                                value="{{ $resource->name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach --}}

<!-- Modal Tambah Grup -->
{{-- @foreach ($resources as $resource)
    <div class="modal fade" id="ModalAdd{{ $resource->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalAdd"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $resource->id }}">Tambah Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="resource_id" id="resource"
                                    value="{{ $resource->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $resource->code }}" readonly>
                                <input type="text" class="form-control" id="back_code" name="code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach --}}
