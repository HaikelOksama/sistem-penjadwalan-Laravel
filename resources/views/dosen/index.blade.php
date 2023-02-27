<x-layout>
    <x-slot:title>Dosen</x-slot:title>
    <x-slot:page>Data Dosen</x-slot:page>
    <div class="row">
        <div class="col-12">
            <livewire:dosen-index></livewire:dosen-index>
            {{-- <div class="card card-success card-outline">
                <div class="card-header row justify-content-between align-items-center">
                    <a href="{{route('dosen.create')}}" class="col-2 btn btn-primary bg-gradient-blue">Data Baru</a>
                    <div class="card-tools col-10 d-flex justify-content-end">
                        <div class="input-group input-group-sm" style="width: 400px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2" style="max-height: 800px;">
                <table class="table table-hover table-bordered table-head-fixed text-nowrap">
                    <thead>
                    <th>
                        #
                    </th>
                    <th>
                        Nama Dosen
                    </th>
                    <th>
                        NIP
                    </th>
                    <th>
                        Matakuliah
                    </th>
                    </thead>
                    <tbody>
                        @if (isset($dosen))
                        @foreach ($dosen as $item)
                        <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->nip}}</td>
                                <td>
                                    @foreach ($item->matakuliah as $matkul)
                                        @if (! $loop->last)
                                            {{$matkul->nama}} ,
                                        @else
                                            {{$matkul->nama}}
                                        @endif
                                    @endforeach
                                </td>                                    
                            </tr>
                            @endforeach
                            @else
                            <tr colspan="4"><td>No Data</td></tr>    
                        @endif
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-end d-flex">
                    <h5 class="text-muted">Menampilkan {{count($dosen)}} Data</h5>
                </div>
            </div> --}}
        <!-- /.card -->
        </div>
    </div>
    <x-slot:livewire>@livewireScripts</x-slot:livewire>
    <script>
        window.addEventListener('dosenSet', () =>{
            
            $('.duallistbox').bootstrapDualListbox()
        })
    </script>
</x-layout>