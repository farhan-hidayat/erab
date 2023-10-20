<!-- Modal Tambah -->
<div class="modal fade" id="ModalLihat" tabindex="-1" role="dialog" aria-labelledby="ModalLihat" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLihat">Detail RPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('rpds.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Tiket RAB</span>
                            </div>
                            <input type="text" class="form-control" id="ticket" name="ticket"
                                value="RAB-20231010" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Komponen</span>
                            </div>
                            <input type="text" name="component_id" class="form-control" value="XXXXXXX" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text">Akun Dana</span>
                            </div>
                            <input type="text" name="type_id" class="form-control" value="XXXXXXX" disabled>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Fakultas Teknik</h4>
                        </div>
                        <div class="card-body">
                            <div class="section-title mt-0">Total RAB : Rp. 1,500,000</div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="5%">#</th>
                                        <th scope="col">Tiket</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>RPD-20231011</td>
                                        <td>Rp. 500,000</td>
                                        <td>Rp. 1,000,000</td>
                                    </tr>
                                </tbody>
                            </table>
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
{{-- @foreach ($resources as $resource)
    <div class="modal fade" id="ModalEdit{{ $resource->id }}" tabindex="-1" role="dialog"
        aria-labelledby="ModalEdit{{ $resource->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalEdit{{ $resource->id }}">Edit Sumber Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('resources.update', $resource->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_code{{ $resource->id }}">Kode</label>
                            <input type="text" class="form-control" id="edit_code{{ $resource->id }}" name="code"
                                value="{{ $resource->code }}">
                        </div>
                        <div class="form-group">
                            <label for="edit_name{{ $resource->id }}">Nama</label>
                            <input type="text" class="form-control" id="edit_name{{ $resource->id }}" name="name"
                                value="{{ $resource->name }}">
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

<!-- Modal Tambah Grup -->
{{-- @foreach ($resources as $resource)
    <div class="modal fade" id="ModalAdd{{ $resource->id }}" tabindex="-1" role="dialog" aria-labelledby="ModalAdd"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalAdd{{ $resource->id }}">Tambah Grup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="resource_id" id="resource"
                                    value="{{ $resource->id }}">
                                <input type="text" class="form-control" id="front_code" name="front_code"
                                    value="{{ $resource->code }}" readonly>
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
@endforeach --}}
