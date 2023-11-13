<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambah">Pengajuan RAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach ($activities as $activity)
                    <div class="form-group d-flex justify-content-center">
                        <a href="{{ route('rabs.edit', $activity->slug) }}"
                            class="btn btn-primary">{{ $activity->code }}-{{ $activity->name }}</a>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
