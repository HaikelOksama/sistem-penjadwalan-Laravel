<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" id="modal-create" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Dosen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="store">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input wire:model="nama" required class="form-control" type="text" name="nama" placeholder="Nama lengkap dengan gelar">
                                @error('nama')
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
                                <legend>Mata Kuliah Diampu</legend>
                                <div class="row justify-content-center align-items-center">
                                    @foreach ($matakuliah as $matkul)
                                    @if ($loop->iteration % 2 == 0)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input wire:model="matakuliahInput" type="checkbox" class="form-check-input" name="matkul[]" id="" value="{{$matkul->id}}">
                                                <label class="form-check-label" for=""><strong>{{$matkul->nama}}</strong></label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input wire:model="matakuliahInput" type="checkbox" class="form-check-input" name="matkul[]" id="" value="{{$matkul->id}}">
                                                <label class="form-check-label" for=""><strong>{{$matkul->nama}}</strong></label>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                                @error('matakuliahInput')
                                <code>{{$message}}</code>
                                @enderror
                            </div>
                            <h2>{{$dismissState}}</h2>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
