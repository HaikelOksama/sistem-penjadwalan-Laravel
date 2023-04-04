<div>
    @livewire('ruangkelas.ruangkelas-create')

    {{-- @foreach ($listKelas as $item)
       @livewire('ruangkelas.ruangkelas-edit', ['ruangkelas' => $item], key($item->id))
    @endforeach --}}

    <div class="card card-success card-outline">
        <div class="card-header">
            
            <a href="{{route('availableTime.show')}}" class="btn btn-primary">Lihat Jadwal</a>
            <a href="{{route('perkuliahan.create')}}" class="btn btn-primary">Baru</a>
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
            <thead class="text-center">
                <th>
                    #
                </th>
                <th>
                    Tahun
                </th>
                <th>
                    Semester
                </th>
                <th>
                    Kelas
                </th>
                <th>
                    Hari/Ruang/Jam
                </th>
                {{-- <th>
                    Ruangan
                </th> --}}
                <th>
                    Lokasi
                </th>
                <th>
                    Nama Dosen
                </th>
                <th>
                    Matakuliah
                </th>
                <th>

                </th>
            </thead>
            <tbody>
                @if (isset($perkuliahan))
                @foreach ($perkuliahan as $data)
                <tr class="text-center ">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->tahun}} ({{Str::title($data->ajaran)}})</td>
                        <td class="text-center">{{$data->semester}}</td>
                        <td>
                            {{$data->kelas}}
                        </td>
                        <td>{{ Str::title($data->getDayName() ?? $data->hari)}}/
                            @if ($data->getRuangan($data->id_kelas)->lokasi == 'kampus_utama')
                            {{$data->getRuangan($data->id_kelas)->kode}}
                            @else
                            SKJD {{$data->getRuangan($data->id_kelas)->kode}}
                            @endif/
                            {{date('H:i', strtotime($data->waktu))}} - {{date('H:i', strtotime($data->berakhir))}}
                        </td>
                        {{-- <td>
                            {{$data->getRuangan($data->id_kelas)->kode}}
                        </td> --}}
                        <td>
                            @if ($data->getRuangan($data->id_kelas)->lokasi == 'kampus_utama')
                            Kampus Utama (Panam)
                            @else
                            Kampus Sukajadi
                            @endif
                        </td>
                        <td>{{$data->getDosenMatakuliah($data->id_dosen_matakuliah)->dosen->nama}}</td>
                        <td>
                            {{$data->getDosenMatakuliah($data->id_dosen_matakuliah)->matakuliah->nama}}
                            ({{$data->getDosenMatakuliah($data->id_dosen_matakuliah)->matakuliah->sks}} SKS)
                        </td>
                        {{-- <td>{{date('H:i', strtotime($data->waktu))}}</td>
                        <td>{{date('H:i', strtotime($data->berakhir))}}</td> --}}
                        <td>
                            <div class="btn-group d-flex justify-content-lg-around ">
                                <a href="{{route('perkuliahan.edit', $data->id)}}"><i title="Edit {{$data->id}}" role="button" class="fas fa-edit text-success"></i></a>
                                <a><i title="Hapus {{$data->id}}" wire:click="$emit('confirmDelete', {{$data}})" id="#delete" type="button" role="button" class="fas fa-trash-restore text-danger"></i></a>
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
                    {{-- {{ $ruangkelas->links() }} --}}
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


