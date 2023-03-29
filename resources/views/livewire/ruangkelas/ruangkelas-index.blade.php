<div>
    @livewire('ruangkelas.ruangkelas-create')

    @foreach ($listKelas as $item)
       @livewire('ruangkelas.ruangkelas-edit', ['ruangkelas' => $item], key($item->id))
    @endforeach

    <div class="card card-success card-outline">
        <div class="card-header">
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
                    Kode Ruangan
                </div>
            </th>
            <th>
                Lokasi
            </th>
            </thead>
            <tbody>
            @if (isset($ruangkelas))
                @foreach ($ruangkelas as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->kode}}</td>
                    <td>{{$item->lokasi()}}</td>
                    <td>
                        <div class="btn-group d-flex justify-content-lg-around ">
                            <a><i title="Edit {{$item->kode}}" data-target="#modal-edit-{{$item->id}}" type="button" data-toggle="modal" role="button" class="fas fa-edit text-success"></i></a>
                            <a><i title="Hapus {{$item->kode}}" wire:click="$emit('confirmDelete', {{$item}})" id="#delete" type="button" role="button" class="fas fa-trash-restore text-danger"></i></a>
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
        <div class="card-footer justify-content-between d-flex">
        
        <div class="col">
            <div class="row">
                <div class="col">
                    {{ $ruangkelas->links() }}
                </div>
                
            </div>
        </div>
        <select wire:model="paginateNumber" class="form-control col-1" name="total" id="">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="0">Semua Data</option>
        </select>
    
        </div>
    </div>
</div>


