<x-layout>
    <x-slot:title>Perkuliahan</x-slot:title>
    
    <div class="container">
        <div class="card">
            <div class="card-header">Perkuliahan</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{route('perkuliahan.create')}}" class="btn btn-primary">Data Baru</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Data</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <th>
                                    #
                                </th>
                                <th>
                                    Semester
                                </th>
                                <th>
                                    Kelas
                                </th>
                                <th>
                                    Hari
                                </th>
                                <th>
                                    Ruangan
                                </th>
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
                                    Dimulai
                                </th>
                                <th>
                                    Berakhir
                                </th>
                            </thead>
                            <tbody>
                                @if (isset($perkuliahan))
                                @foreach ($perkuliahan as $data)
                                <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-center">{{$data->semester}}</td>
                                        <td>
                                            {{$data->kelas}}
                                        </td>
                                        <td>{{ Str::title($data->hari)}}</td>
                                        <td>
                                            {{$data->getRuangan($data->id_kelas)->kode}}
                                        </td>
                                        <td>
                                            @if ($data->getRuangan($data->id_kelas)->lokasi == 'kampus_utama')
                                            Kampus Utama (Panam)
                                            @else
                                            Kampus Sukajadi
                                            @endif
                                        </td>
                                        <td>{{$data->getDosenMatakuliah($data->id_dosen_matakuliah)->dosen->nama}}</td>
                                        <td>{{$data->getDosenMatakuliah($data->id_dosen_matakuliah)->matakuliah->nama}}</td>
                                        <td>{{date('H:i', strtotime($data->waktu))}}</td>
                                        <td>{{date('H:i', strtotime($data->berakhir))}}</td>
                                </tr>
                                    @endforeach
                                    @else
                                    <tr colspan="4"><td>No Data</td></tr>    
                                @endif

                            </tbody>
                        </table>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>