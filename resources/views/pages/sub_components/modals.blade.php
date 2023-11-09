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
            <form method="POST" action="{{ route('subs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="component">Komponen</label>
                        <select name="component_id" id="component" class="form-control selectric">
                            <option value="">Pilih Komponen</option>
                            @foreach ($components as $component)
                                <option value="{{ $component->id }}" data-front-code="{{ $component->code }}">
                                    {{ $component->name }}</option>
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
@foreach ($sub_components as $subcom)
    <div class="modal fade" id="ModalEdit{{ $subcom->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $subcom->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $subcom->id }}">Edit Komponen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('subs.update', $subcom->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="component">Komponen</label>
                            <select name="component_id" id="componentedit{{ $subcom->id }}"
                                class="form-control selectric">
                                @foreach ($components as $component)
                                    <option data-front-code-edit="{{ $component->code }}"
                                        value="{{ $component->id }}"{{ $component->id == $subcom->component_id ? 'selected' : '' }}>
                                        {{ $component->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="front_code_edit{{ $subcom->id }}"
                                    name="front_code_edit" value="{{ $subcom->component->code }}" readonly>
                                @php
                                    $parts = explode('.', $subcom->code);
                                    $lastPart = end($parts);
                                @endphp
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ $lastPart }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $subcom->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $subcom->id }}" name="name"
                                value="{{ $subcom->name }}">
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
