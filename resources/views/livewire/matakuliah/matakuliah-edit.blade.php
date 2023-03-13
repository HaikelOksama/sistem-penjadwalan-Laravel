<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" data-backdrop="static" id="modal-edit" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div wire:loading.class.shortest="overlay" role="status">
                    <i wire:loading.class.shortest="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Data Matakuliah</h4>
                    <button type="button" wire:click="clearInput" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="update({{$matkulId}})">
                            <div class="form-group">
                                <label for="nama">Nama Matakuliah</label>
                                <input wire:model.defer="nama" required class="form-control" type="text" name="nama" placeholder="Nama Matakuliah">
                                @error('nama')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Kode Matakuliah</label>
                                <input wire:model.defer="kode" required class="form-control" type="text" placeholder="Kode Matakuliah">
                                @error('kode')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">SKS</label>
                                <input wire:model.defer="sks" max="3" min="1" required class="form-control" type="number">
                                @error('sks')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            
                            <div class="modal-footer justify-content-between">
                                <button type="button" wire:click="clearInput" class="btn btn-default" data-dismiss="modal">Close</button>
                                <div class="btn-group">
                        
                                    <button type="submit" class="btn btn-primary">Simpan</button>

                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

