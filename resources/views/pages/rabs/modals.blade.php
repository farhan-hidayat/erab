<!-- Modal Tambah -->
{{-- <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah"
    aria-hidden="true">
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
                    <a href="{{ route('rabs.edit', $activity->slug) }}" class="btn btn-primary">{{ $activity->code }}-{{
                        $activity->name }}</a>
                    <br>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Ubah -->
@foreach ($rab_requests as $rab_request)
<div class="modal fade" id="ModalEdit{{ $rab_request->id }}" tabindex="-1" role="dialog"
    aria-labelledby="ModalEdit{{ $rab_request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalEdit{{ $rab_request->id }}">Edit Pengajuan RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('requests.update', $rab_request->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_description{{ $rab_request->id }}">Deskripsi</label>
                        {{-- <textarea id="description" name="description">{!! $rab_request->description !!}</textarea>
                        --}}
                        <input type="text" class="form-control" id="edit_description{{ $rab_request->id }}"
                            name="description" value="{{ $rab_request->description }}">
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Volume</span>
                            </div>
                            <input type="number" class="form-control" id="volume{{ $rab_request->id }}" name="volume"
                                value="{{ $rab_request->volume }}">
                            <div class="input-group-append">
                                <span class="input-group-text">Satuan</span>
                            </div>
                            <input type="text" class="form-control" id="unit" name="unit"
                                value="{{ $rab_request->unit }}">
                            <div class="input-group-append">
                                <span class="input-group-text">Harga</span>
                            </div>
                            <input type="text" class="form-control currency{{ $rab_request->id }}"
                                id="price{{ $rab_request->id }}" name="price"
                                value=" Rp. {{ number_format($rab_request->price) }}">
                            <div class="input-group-append">
                                <span class="input-group-text">Total</span>
                            </div>
                            <input type="text" class="form-control currency" id="total{{ $rab_request->id }}"
                                name="total" value=" Rp. {{ number_format($rab_request->total) }}" readonly>
                        </div>
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
@endforeach

<!-- Modal Verifikasi RAB -->
{{-- @foreach ($rabs as $rab)
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
                            <tr>
                                <th colspan="6">
                                    {{ $rab_detail->type->code }}-{{ $rab_detail->type->name }}
                                </th>
                                @php
                                $currentType = $rab_detail->type->id;
                                $no = 1; // Reset $no when type changes
                                @endphp
                            </tr>
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" style="border: none;"
                                        disabled>{{ $rab_detail->description }}</textarea>
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
                    <button type="submit" class="btn btn-success btn-terima" onclick="setStatus('DITERIMA')"
                        data-id="{{ $rab->id }}">Terima</button>
                    <button type="submit" class="btn btn-danger btn-tolak" onclick="setStatus('DITOLAK')"
                        data-id="{{ $rab->id }}">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}