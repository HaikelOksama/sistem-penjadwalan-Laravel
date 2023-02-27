<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
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
</div>
