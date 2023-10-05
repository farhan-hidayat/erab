<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Klasifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('classifications.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="activity">Kegiatan</label>
                        <select name="activity_id" id="activity" class="form-control selectric">
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}" data-front-code="{{ $activity->code }}">
                                    {{ $activity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="code">Kode</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="front_code" name="front_code" readonly>
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

<!-- Modal Ubah -->
@foreach ($classifications as $classification)
    <div class="modal fade" id="ModalEdit{{ $classification->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $classification->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $classification->id }}">Edit Klasifikasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('classifications.update', $classification->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="activity">Kegiatan</label>
                            <select name="activity_id" id="activityedit{{ $classification->id }}"
                                class="form-control selectric">
                                @foreach ($activities as $activity)
                                    <option data-front-code-edit="{{ $activity->code }}"
                                        value="{{ $activity->id }}"{{ $activity->id == $classification->activity_id ? 'selected' : '' }}>
                                        {{ $activity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    id="front_code_edit{{ $classification->id }}" name="front_code_edit"
                                    value="{{ $classification->activity->code }}" readonly>
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ substr($classification->code, strpos($classification->code, '.') + 1) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $classification->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $classification->id }}"
                                name="name" value="{{ $classification->name }}">
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

<!-- Modal Tambah Detail -->
@foreach ($classifications as $classification)
    <div class="modal fade" id="ModalAdd{{ $classification->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $classification->id }}">Tambah Rincian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('details.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="classification_id"
                                    id="classification" value="{{ $classification->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $classification->code }}" readonly>
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
@endforeach
