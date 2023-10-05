<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Tambah Grup</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="resource">Sumber Dana</label>
                        <select name="resource_id" id="resource" class="form-control selectric">
                            <option value="">Pilih Sumber Dana</option>
                            @foreach ($resources as $resource)
                                <option value="{{ $resource->id }}" data-front-code="{{ $resource->code }}">
                                    {{ $resource->name }}</option>
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
@foreach ($groups as $group)
    <div class="modal fade" id="ModalEdit{{ $group->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $group->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $group->id }}">Edit Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('groups.update', $group->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="resource">Sumber Dana</label>
                            <select name="resource_id" id="resourceedit{{ $group->id }}"
                                class="form-control selectric">
                                @foreach ($resources as $resource)
                                    <option data-front-code-edit="{{ $resource->code }}"
                                        value="{{ $resource->id }}"{{ $resource->id == $group->resource_id ? 'selected' : '' }}>
                                        {{ $resource->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="front_code_edit{{ $group->id }}"
                                    name="front_code_edit" value="{{ $group->resource->code }}" readonly>
                                <input type="text" class="form-control" id="back_code" name="code"
                                    value="{{ substr($group->code, strpos($group->code, '.') + 1) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $group->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $group->id }}" name="name"
                                value="{{ $group->name }}">
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
@foreach ($groups as $group)
    <div class="modal fade" id="ModalAdd{{ $group->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalAdd" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $group->id }}">Tambah Rincian</h5>
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
                                <input type="hidden" class="form-control" name="group_id" id="group"
                                    value="{{ $group->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $group->code }}" readonly>
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
