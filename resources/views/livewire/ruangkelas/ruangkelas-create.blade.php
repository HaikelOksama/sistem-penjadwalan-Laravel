<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" data-backdrop="static" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Matakuliah</h4>
                    <button type="button" wire:click="clearInput" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="form-group">
                                <label for="nama">Kode Ruangan</label>
                                <input wire:model.defer="kode" required class="form-control" type="text" name="kode" placeholder="Kode Ruangan">
                                @error('kode')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Lokasi</label>
                                <select class="form-control" name="" wire:model="lokasi" id="">
                                    <option selected value="kampus_utama">Kampus Utama</option>
                                    <option value="kampus_sukajadi">Kampus Sukajadi</option>
                                </select>
                                @error('lokasi')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" wire:click="clearInput" class="btn btn-default" data-dismiss="modal">Close</button>
                                <div class="btn-group">
                                    <button type="submit" wire:click="$set('dismissState', false)" class="btn btn-info">Simpan dan Tambah Lagi</button>
                                    <button type="submit" wire:click="$set('dismissState', true)" class="btn btn-primary">Simpan</button>

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

