<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Pengajuan RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($activities as $activity)
                    <div class="form-group d-flex justify-content-center">
                        <a href="{{ route('rabs.edit', $activity->slug) }}"
                            class="btn btn-primary">{{ $activity->code }}-{{ $activity->name }}</a>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

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
                    @if (Auth::user()->roles == 'USER')
                        <form method="POST" action="{{ route('rpds.store') }}" enctype="multipart/form-data">
                            @csrf
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
                                        <!-- @php
                                            $currentYear = now()->year;
                                            $currentMonth = now()->month;
                                        @endphp -->

                                        @for ($i = 1; $i <= 12; $i++)
                                            @php
                                                $formattedMonth = date('F', mktime(0, 0, 0, $i, 1));
                                            @endphp
                                            <option value="{{ $i }}">{{ $formattedMonth }}</option>
                                        @endfor
                                        <!--
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
                                        -->
                                    </select>
                                </div>
                            </div>
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
                                        <span class="input-group-text">Cairkan</span>
                                    </div>
                                    <input type="text" name="price" id="rpd_price{{ $rab->id }}"
                                        class="form-control currency{{ $rab->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="rab_id" value="{{ $rab->id }}">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    @else
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Tiket RAB</span>
                                </div>
                                <input type="text" class="form-control" id="ticket" name="ticket"
                                    value="{{ $rab->ticket }}" disabled>
                            </div>
                        </div>
                    @endif

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
                                                    <form action="{{ route('rpds.update', $rpd->id) }}"
                                                        method="post">
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
                                                <th scope="row" colspan="7" class="text-center">
                                                    <h1>Belum ada pencairan dana</h1>
                                                </th>
                                            @else
                                                <th scope="row" colspan="6" class="text-center">
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

<!-- Modal Detail RAB -->
@foreach ($rabs as $rab)
    <div class="modal fade" id="ModalVerifikasi{{ $rab->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalVerifikasi{{ $rab->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalVerifikasi{{ $rab->id }}">Verifikasi RAB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="myForm{{ $rab->id }}" method="POST" action="{{ route('rabs.update', $rab->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalVerifikasi{{ $rab->id }}">{{ $rab->ticket }}</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">#</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" width="12%">Volume</th>
                                    <th scope="col" width="15%">Satuan</th>
                                    <th scope="col" width="18%">Harga</th>
                                    <th scope="col" width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $totalKeseluruhan = 0;
                                    $currentSubComponent = null;
                                    $currentType = null;
                                @endphp
                                @foreach ($rab_details->where('rab_id', $rab->id) as $rab_detail)
                                    @if ($currentSubComponent !== $rab_detail->sub_component->id)
                                    <tr>
                                        <th colspan="6">
                                            {{ $rab_detail->sub_component->code }}-{{ $rab_detail->sub_component->name }}
                                        </th>
                                        @php
                                            $currentSubComponent = $rab_detail->sub_component->id;
                                            $currentType = null; // Reset currentType when sub_component changes
                                            $no = 1; // Reset $no when sub_component changes
                                        @endphp
                                    </tr>
                                    @endif
                                    @if ($currentType !== $rab_detail->type->id)
                                    <tr>
                                        <th colspan="6">
                                            {{ $rab_detail->type->code }}-{{ $rab_detail->type->name }}
                                        </th>
                                        @php
                                            $currentType = $rab_detail->type->id;
                                            $no = 1; // Reset $no when type changes
                                        @endphp
                                    </tr>
                                    @endif
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" style="border: none;" disabled>{{ $rab_detail->description }}</textarea>
                                        </td>
                                        <td>{{ $rab_detail->volume }}</td>
                                        <td>{{ $rab_detail->unit }}</td>
                                        <td>Rp. {{ number_format($rab_detail->price) }}</td>
                                        <td>Rp. {{ number_format($rab_detail->total) }}</td>
                                    </tr>
                                    @php
                                        $totalKeseluruhan += $rab_detail->total;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right">Total Keseluruhan</th>
                                    <input type="hidden" name="totalKeseluruhan" value="{{ $totalKeseluruhan }}">
                                    <th colspan="2">Rp. {{ number_format($totalKeseluruhan) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="status" id="status{{ $rab->id }}" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="submit" class="btn btn-success btn-terima" onclick="setStatus('DITERIMA')"
                            data-id="{{ $rab->id }}">Terima</button>
                        <button type="submit" class="btn btn-danger btn-tolak" onclick="setStatus('DITOLAK')"
                            data-id="{{ $rab->id }}">Tolak</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
