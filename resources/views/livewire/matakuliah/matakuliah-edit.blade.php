<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" data-backdrop="static" id="modal-edit-{{$matakuliahClass->id}}" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div wire:loading.class.shortest="overlay" role="status">
                    <i wire:loading.class.shortest="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title">Data Matakuliah</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <select required class="form-control" wire:model.defer="sks" name="" id="">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                @error('sks')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

