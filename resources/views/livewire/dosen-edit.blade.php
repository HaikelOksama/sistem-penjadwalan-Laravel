<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" id="modal-edit" data-backdrop="static" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title mr-3">Data Dosen</h4>
                    <div wire:loading class="spinner-border text-primary " role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetData()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        
                        <form wire:submit.prevent="updateDosen">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input wire:model.defer="nama" required class="form-control" type="text" name="nama" placeholder="Nama lengkap dengan gelar">
                                @error('nama')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">NIP</label>
                                <input wire:model.defer="nip" required class="form-control" type="text" name="nip" placeholder="NIP">
                                @error('nip')
                                    <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="form-group">
                                <legend>Mata Kuliah Diampu</legend>
                                {{-- @if (isset($dosen))
                                    
                                <livewire:dosen-matakuliah :dosen="$dosen"></livewire:dosen-matakuliah>
                                @endif --}}
                                <div class="row justify-content-center align-items-center">
                                    @if (isset($matakuliahList))
                                    @foreach ($matakuliahList as $matkul)
                                    @if ($loop->iteration % 2 == 0)
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input
                                                wire:model.defer="matakuliahSelected" type="checkbox" class="form-check-input" name="matkul[]" id="matkul_{{ $matkul->id }}" value="{{$matkul->id}}"
                                                @if (isset($dosen))
                                                    @if (in_array($matkul->id, $matakuliahSelected))
                                                    checked
                                                    @endif                                       
                                                @endif
                                                >
                                                <label class="form-check-label" for=""><strong>{{$matkul->nama}}</strong></label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-6">
                                            <div class="form-check">
                                                <input 
                                                wire:model.defer="matakuliahSelected" type="checkbox" class="form-check-input" name="matkul[]" id="matkul_{{ $matkul->id }}" value="{{$matkul->id}}"
                                                @if (isset($dosen))
                                                    @if (in_array($matkul->id, $matakuliahSelected))
                                                    checked
                                                    @endif                                       
                                                @endif
                                                >
                                                <label class="form-check-label" for=""><strong>{{$matkul->nama}}</strong></label>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                    @endif
                                    
                                </div>
                                
                                @error('matakuliahInput')
                                <code>{{$message}}</code>
                                @enderror
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button wire:click="resetData()" type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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


