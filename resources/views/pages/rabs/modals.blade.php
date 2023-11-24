<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Data RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Klasifikasi</span>
                            </div>
                            <select name="classification_id" id="classificationTD" class="form-control">
                                <option value="">Pilih Kegiatan</option>
                                @foreach ($classifications as $classification)
                                <option value="{{ $classification->id }}">
                                    {{ $classification->code }} -
                                    {{ $classification->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rincian</span>
                            </div>
                            <select name="detail_id" id="detailTD" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">

                            <div class="input-group-append">
                                <span class="input-group-text">Komponen</span>
                            </div>
                            <select name="component_id" id="componentTD" class="form-control">
                            </select>
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sub Komponen</span>
                            </div>
                            <select name="sub_component_id" id="sub_componentTD" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">

                            <div class="input-group-append">
                                <span class="input-group-text">Akun Belanja</span>
                            </div>
                            <select name="type_id" class="form-control">
                                <option value="">Pilih Akun Belanja</option>
                                @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->code }} -
                                    {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" width="15%">Volume</th>
                                <th scope="col" width="15%">Satuan</th>
                                <th scope="col" width="18%">Harga</th>
                                <th scope="col" width="20%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea name="description" id="description" cols="30" rows="3"
                                        style="border: none;"></textarea>
                                </td>
                                <td>
                                    <input type="number" class="form-control" id="volume" name="volume" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="unit" name="unit">
                                </td>
                                <td>
                                    <input type="text" class="form-control currency" id="price" name="price">
                                </td>
                                <td>
                                    <input type="text" class="form-control currency" id="total" name="total"
                                        placeholder="Rp. 0" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah Item -->
@foreach ($rab_requests as $rab_request)
<div class="modal fade" id="ModalTambahan{{ $rab_request->id }}" tabindex="-1" role="dialog"
    aria-labelledby="ModalTambahan{{ $rab_request->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahan{{ $rab_request->id }}">Tambah RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('requests.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sub Komponen</span>
                            </div>
                            <input type="hidden" class="form-control" id="sub_component_id" name="sub_component_id"
                                value="{{ $rab_request->sub_component_id }}">
                            <input type="text" class="form-control"
                                value="{{ $rab_request->sub_component->code }} - {{ $rab_request->sub_component->name }}"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Sumber Dana</span>
                            </div>
                            <input type="hidden" class="form-control" id="type_id" name="type_id"
                                value="{{ $rab_request->type_id }}">
                            <input type="text" class="form-control"
                                value="{{ $rab_request->type->code }} - {{ $rab_request->type->name }}" readonly>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Deskripsi</th>
                                <th scope="col" width="15%">Volume</th>
                                <th scope="col" width="15%">Satuan</th>
                                <th scope="col" width="18%">Harga</th>
                                <th scope="col" width="20%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea name="description" id="description" cols="30" rows="3"
                                        style="border: none;"></textarea>
                                </td>
                                <td>
                                    <input type="number" class="form-control" id="volumeTB{{ $rab_request->id }}"
                                        name="volume" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="unit" name="unit">
                                </td>
                                <td>
                                    <input type="text" class="form-control currencyTB{{ $rab_request->id }}"
                                        id="priceTB{{ $rab_request->id }}" name="price">
                                </td>
                                <td>
                                    <input type="text" class="form-control currency" id="totalTB{{ $rab_request->id }}"
                                        name="total" placeholder="Rp. 0" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="activity_id" value="{{ $activity->id }}">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

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