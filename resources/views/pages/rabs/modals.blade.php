<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Pengajuan RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('rabs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Kegiatan</span>
                            </div>
                            <select name="activity_id" id="activityTD" class="form-control">
                                <option value="">Pilih Kegiatan</option>
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">Klasifikasi</span>
                            </div>
                            <select name="classification_id" id="classificationTD" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rincian</span>
                            </div>
                            <select name="detail_id" id="detailTD" class="form-control">
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">Komponen</span>
                            </div>
                            <select name="component_id" id="componentTD" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Sumber Dana</span>
                            </div>
                            <select name="resource_id" id="resourceTD" class="form-control">
                                <option value="">Pilih Sumber Dana</option>
                                @foreach ($resources as $resource)
                                    <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">Kelompok Akun</span>
                            </div>
                            <select name="group_id" id="groupTD" class="form-control">
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text">Akun</span>
                            </div>
                            <select name="type_id" id="typeTD" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="summernote-simple" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Volume</span>
                            </div>
                            <input type="number" class="form-control" id="volume" name="volume"
                                placeholder="Volume">
                            <div class="input-group-append">
                                <span class="input-group-text">Frequency</span>
                            </div>
                            <input type="number" class="form-control" id="frequency" name="frequency"
                                placeholder="Frequency">
                            <div class="input-group-append">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control currency" id="price" name="price"
                                placeholder="Price">
                        </div>
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

<!-- Modal Ubah -->
@foreach ($rabs as $rab)
    <div class="modal fade" id="ModalEdit{{ $rab->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $rab->id }}" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $rab->id }}">Edit Pengajuan RAB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('rabs.update', $rab->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_ticket{{ $rab->id }}">Tiket</label>
                            <input type="text" class="form-control" id="edit_ticket{{ $rab->id }}"
                                name="ticket" value="{{ $rab->ticket }}" disabled>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Kegiatan</span>
                                </div>
                                <select name="activity_id" id="activityED{{ $rab->id }}" class="form-control">
                                    <option value="">Pilih Kegiatan</option>
                                    @foreach ($activities as $activity)
                                        <option
                                            value="{{ $activity->id }}"{{ $activity->id == $rab->activity_id ? 'selected' : '' }}>
                                            {{ $activity->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Klasifikasi</span>
                                </div>
                                <select name="classification_id" id="classificationED{{ $rab->id }}"
                                    class="form-control">
                                    @foreach ($classifications as $classification)
                                        <option
                                            value="{{ $classification->id }}"{{ $classification->id == $rab->classification_id ? 'selected' : '' }}>
                                            {{ $classification->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rincian</span>
                                </div>
                                <select name="detail_id" id="detailED{{ $rab->id }}" class="form-control">
                                    @foreach ($details as $detail)
                                        <option
                                            value="{{ $detail->id }}"{{ $detail->id == $rab->detail_id ? 'selected' : '' }}>
                                            {{ $detail->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Komponen</span>
                                </div>
                                <select name="component_id" id="componentED{{ $rab->id }}"
                                    class="form-control">
                                    @foreach ($components as $component)
                                        <option
                                            value="{{ $component->id }}"{{ $component->id == $rab->component_id ? 'selected' : '' }}>
                                            {{ $component->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sumber Dana</span>
                                </div>
                                <select name="resource_id" id="resourceED{{ $rab->id }}" class="form-control">
                                    @foreach ($resources as $resource)
                                        <option
                                            value="{{ $resource->id }}"{{ $resource->id == $rab->resource_id ? 'selected' : '' }}>
                                            {{ $resource->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kelompok Akun</span>
                                </div>
                                <select name="group_id" id="groupED{{ $rab->id }}" class="form-control">
                                    @foreach ($groups as $group)
                                        <option
                                            value="{{ $group->id }}"{{ $group->id == $rab->group_id ? 'selected' : '' }}>
                                            {{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Akun</span>
                                </div>
                                <select name="type_id" id="typeED{{ $rab->id }}" class="form-control">
                                    @foreach ($types as $type)
                                        <option
                                            value="{{ $type->id }}"{{ $type->id == $rab->type_id ? 'selected' : '' }}>
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_description{{ $rab->id }}">Deskripsi</label>
                            <textarea class="summernote-simple" id="description" name="description">{!! $rab->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Volume</span>
                                </div>
                                <input type="number" class="form-control" id="volume" name="volume"
                                    value="{{ $rab->volume }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Frequency</span>
                                </div>
                                <input type="number" class="form-control" id="frequency" name="frequency"
                                    value="{{ $rab->frequency }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control currency" id="price" name="price"
                                    value="{{ number_format($rab->price) }}">
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
@foreach ($rabs as $rab)
    <div class="modal fade" id="ModalVerifikasi{{ $rab->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalVerifikasi{{ $rab->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_ticket{{ $rab->id }}">Tiket</label>
                            <input type="text" class="form-control" id="edit_ticket{{ $rab->id }}"
                                name="ticket" value="{{ $rab->ticket }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit_component{{ $rab->id }}">Komponen</label>
                            <input type="text" class="form-control" id="edit_component{{ $rab->id }}"
                                name="component" value="{{ $rab->type->code }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="edit_type{{ $rab->id }}">Akun Sumber Dana</label>
                            <input type="text" class="form-control" id="edit_type{{ $rab->id }}"
                                name="type_id" value="{{ $rab->type->code }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="summernote-simple" id="description" name="description">{!! $rab->description !!}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Volume</span>
                                </div>
                                <input type="number" class="form-control" id="volume" name="volume"
                                    value="{{ $rab->volume }}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">Frequency</span>
                                </div>
                                <input type="number" class="form-control" id="frequency" name="frequency"
                                    value="{{ $rab->frequency }}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control currency" id="price" name="price"
                                    value="{{ number_format($rab->price) }}" disabled>
                            </div>
                        </div>
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
@endforeach

<!-- Modal Tambah RAB langsung Classification -->
@foreach ($components as $component)
    <div class="modal fade" id="ModalAdd{{ $component->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalAdd" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $component->id }}">Pengajuan RAB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('rabs.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="component_id" id="component"
                                    value="{{ $component->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $component->code }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sumber Dana</span>
                                </div>
                                <select name="resource_id" id="resourceTD{{ $component->id }}" class="form-control">
                                    <option value="">Pilih Sumber Dana</option>
                                    @foreach ($resources as $resource)
                                        <option value="{{ $resource->id }}">{{ $resource->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Kelompok Akun</span>
                                </div>
                                <select name="group_id" id="groupTD{{ $component->id }}" class="form-control">
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text">Akun</span>
                                </div>
                                <select name="type_id" id="typeTD{{ $component->id }}" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="summernote-simple" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Volume</span>
                                </div>
                                <input type="number" class="form-control" id="volume" name="volume"
                                    placeholder="Volume">
                                <div class="input-group-append">
                                    <span class="input-group-text">Frequency</span>
                                </div>
                                <input type="number" class="form-control" id="frequency" name="frequency"
                                    placeholder="Frequency">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" class="form-control currency" id="price" name="price"
                                    placeholder="Price">
                            </div>
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
@endforeach
