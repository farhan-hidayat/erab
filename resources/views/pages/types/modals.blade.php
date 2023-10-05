<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Tipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('types.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="group">Grup</label>
                        <select name="group_id" id="group" class="form-control selectric">
                            <option value="">Pilih Grup</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" data-front-code="{{ $group->code }}">
                                    {{ $group->name }}</option>
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
@foreach ($types as $type)
    <div class="modal fade" id="ModalEdit{{ $type->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $type->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $type->id }}">Edit Tipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('types.update', $type->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="group">Grup</label>
                            <select name="group_id" id="groupedit{{ $type->id }}" class="form-control selectric">
                                @foreach ($groups as $group)
                                    <option data-front-code-edit="{{ $group->code }}"
                                        value="{{ $group->id }}"{{ $group->id == $type->group_id ? 'selected' : '' }}>
                                        {{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="front_code_edit{{ $type->id }}"
                                    name="front_code_edit" value="{{ $type->group->code }}" readonly>
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ substr($type->code, strpos($type->code, '.') + 1) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $type->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $type->id }}" name="name"
                                value="{{ $type->name }}">
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
