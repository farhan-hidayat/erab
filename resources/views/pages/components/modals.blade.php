<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Komponen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('components.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="detail">Rincian</label>
                        <select name="detail_id" id="detail" class="form-control selectric">
                            <option value="">Pilih Rincian</option>
                            @foreach ($details as $detail)
                                <option value="{{ $detail->id }}" data-front-code="{{ $detail->code }}">
                                    {{ $detail->name }}</option>
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
@foreach ($components as $component)
    <div class="modal fade" id="ModalEdit{{ $component->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $component->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $component->id }}">Edit Komponen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('components.update', $component->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="detail">Klasifikasi</label>
                            <select name="detail_id" id="detailedit{{ $component->id }}" class="form-control selectric">
                                @foreach ($details as $detail)
                                    <option data-front-code-edit="{{ $detail->code }}"
                                        value="{{ $detail->id }}"{{ $detail->id == $component->detail_id ? 'selected' : '' }}>
                                        {{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="front_code_edit{{ $component->id }}"
                                    name="front_code_edit" value="{{ $component->detail->code }}" readonly>
                                @php
                                    $parts = explode('.', $component->code);
                                    $lastPart = end($parts);
                                @endphp
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ $lastPart }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $component->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $component->id }}"
                                name="name" value="{{ $component->name }}">
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
