<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" data-backdrop="static" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Dosen</h4>
                    <button type="button" wire:click="clearInput" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input wire:model="nama" wire:blur="generateInisial" required class="form-control" type="text" name="nama" placeholder="Nama lengkap dengan gelar">
                                @error('nama')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Inisial Dosen</label>
                                <input wire:model="inisial" required class="form-control" type="text" name="inisial" placeholder="Nama Inisial">
                                @error('inisial')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">NIP</label>
                                <input wire:model="nip" required class="form-control" type="text" name="nip" placeholder="NIP">
                                @error('nip')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                @error('matakuliahInput')
                                <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div wire:ignore class="form-group">
                                <legend>Mata Kuliah Diampu</legend>
                                <select required wire:model="matakuliahInput" name="selected[]" id="#selectCreate" class="select2" multiple data-placeholder="Pilih matakuliah" style="width: 100%;">
                                @if (isset($matakuliahList))
                                    @foreach ($matakuliahList as $matkul)
                                    <option value="{{$matkul->id}}">{{$matkul->nama}}</option>
                                    @endforeach
                                @endif
                                </select>
                                @error('matakuliahInput')
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
