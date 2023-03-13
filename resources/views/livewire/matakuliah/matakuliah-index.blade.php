<div>
    {{-- <livewire:dosen.dosen-create></livewire:dosen.dosen-create>
    <livewire:dosen.dosen-edit></livewire:dosen.dosen-edit> --}}
    @livewire('matakuliah.matakuliah-create')
    @livewire('matakuliah.matakuliah-edit')
    
    <div class="card card-success card-outline">
        <div class="card-header">
            {{-- <a href="{{route('dosen.create')}}" class="col-2 btn btn-primary bg-gradient-blue">Data Baru</a> --}}
            
            <button style="width: auto; font-size: clamp(12px, 1vw, 20px);" class="col-auto btn btn-primary bg-gradient-blue" type="button" data-toggle="modal" data-target="#modal-create">Tambah <i class="fas fa-plus-square"></i></button>
            <div class="card-tools col-10 d-flex justify-content-end">
                <div class="input-group input-group-sm" style="width: 40%;">
                    <input wire:model="search" type="text" name="search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="max-height: 800px;">
        <table class="table table-hover table-bordered table-head-fixed text-nowrap overflow-y-hidden">
            <thead class="thead-light bg-cyan table-danger">
            <th>
                #
            </th>
            <th>
                <div class="row justify-content-between align-content-center">
                    Nama Matakuliah
                </div>
            </th>
            <th>
                Kode
            </th>
            <th>
                SKS
            </th>

            </thead>
            <tbody wire:poll.5000ms>
            @if (isset($matakuliah))
                @foreach ($matakuliah as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->kode}}</td>
                    <td>3</td>  
                    <td>
                        <div class="btn-group d-flex justify-content-lg-around ">
                            <a><i title="Edit {{$item->nama}}" data-target="#modal-edit" type="button" data-toggle="modal" wire:click="getMatakuliah({{$item->id}})" role="button" class="fas fa-edit text-success"></i></a>
                            <a><i title="Hapus {{$item->nama}}" wire:click="$emit('confirmDelete', {{$item}})" id="#delete" type="button" role="button" class="fas fa-trash-restore text-danger"></i></a>
                        </div>
                    </td>                                 
                </tr>
                @endforeach
            @else
            <tr colspan="4"><td>No Data</td></tr>    
            @endif
            </tbody>
        </table>
        </div>
    </div>
</div>


