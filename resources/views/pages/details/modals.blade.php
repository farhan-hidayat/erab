<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Rincian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('details.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="classification">Klasifikasi</label>
                        <select name="classification_id" id="classification" class="form-control selectric">
                            <option value="">Pilih Klasifikasi</option>
                            @foreach ($classifications as $classification)
                                <option value="{{ $classification->id }}" data-front-code="{{ $classification->code }}">
                                    {{ $classification->name }}</option>
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
@foreach ($details as $detail)
    <div class="modal fade" id="ModalEdit{{ $detail->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $detail->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $detail->id }}">Edit Rincian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('details.update', $detail->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="classification">Klasifikasi</label>
                            <select name="classification_id" id="classificationedit{{ $detail->id }}"
                                class="form-control selectric">
                                @foreach ($classifications as $classification)
                                    <option data-front-code-edit="{{ $classification->code }}"
                                        value="{{ $classification->id }}"{{ $classification->id == $detail->classification_id ? 'selected' : '' }}>
                                        {{ $classification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="front_code_edit{{ $detail->id }}"
                                    name="front_code_edit" value="{{ $detail->classification->code }}" readonly>
                                @php
                                    $parts = explode('.', $detail->code);
                                    $lastPart = end($parts);
                                @endphp
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ $lastPart }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $detail->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $detail->id }}" name="name"
                                value="{{ $detail->name }}">
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

<!-- Modal Tambah Component -->
@foreach ($details as $detail)
    <div class="modal fade" id="ModalAdd{{ $detail->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $detail->id }}">Tambah Komponen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('components.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="detail_id" id="detail"
                                    value="{{ $detail->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $detail->code }}" readonly>
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
