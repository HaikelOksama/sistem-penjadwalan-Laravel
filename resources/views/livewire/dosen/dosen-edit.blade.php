<div>
    {{-- The whole world belongs to you. --}}
    <div class="modal fade" id="modal-edit" data-backdrop="static" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div wire:loading.class.shortest="overlay" role="status">
                    <i wire:loading.class.shortest="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title mr-3">Data Dosen</h4>
                    {{-- <div wire:loading class="spinner-border text-primary " role="status">
                        <span class="sr-only">Loading...</span>
                      </div> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="resetData()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        
                        {{-- <form action="{{route('dosen.update')}}" method="POST">
                            @method('PUT')
                            @csrf --}}
                        <form wire:submit.prevent='updateDosen'>
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
                            
                            <div wire:ignore class="form-group">
                                <legend>Mata Kuliah Diampu</legend>
                                <select required wire:model.defer="matakuliahInput" name="selected[]" id="#selectMatkul" class="select2" multiple data-placeholder="Pilih matakuliah" style="width: 100%;">
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
                                <button wire:click="resetData()" type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <x-slot:script>
       <script>
        Livewire.on('getMatakuliah', matkul => {
            console.log('getMatakul')
            $('.select2').select2();
            $('.select2').val(matkul).trigger('change');
            
        })

        Livewire.on('resetData', () => {    
            $('.select2').val(null).trigger('change');
        })

       </script>
    </x-slot:script>
</div>





