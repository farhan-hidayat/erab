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
                            <input type="number" class="form-control" id="volume" name="volume"
                                placeholder="Volume">
                            <input type="number" class="form-control" id="frequency" name="frequency"
                                placeholder="Frequency">
                            <input type="number" class="form-control" id="price" name="price"
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
{{-- @foreach ($activities as $activity)
    <div class="modal fade" id="ModalEdit{{ $activity->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $activity->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $activity->id }}">Edit Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('activities.update', $activity->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_code{{ $activity->id }}">Kode</label>
                            <input type="text" class="form-control" id="edit_code{{ $activity->id }}" name="code"
                                value="{{ $activity->code }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $activity->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $activity->id }}" name="name"
                                value="{{ $activity->name }}">
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

<!-- Modal Tambah RAB langsung Classification -->
@foreach ($components as $component)
    <div class="modal fade" id="ModalAdd{{ $component->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalAdd"
        aria-hidden="true">
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
                                <input type="number" class="form-control" id="volume" name="volume"
                                    placeholder="Volume">
                                <input type="number" class="form-control" id="frequency" name="frequency"
                                    placeholder="Frequency">
                                <input type="number" class="form-control" id="price" name="price"
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
