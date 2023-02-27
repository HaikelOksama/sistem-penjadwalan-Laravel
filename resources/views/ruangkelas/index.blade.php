<x-layout>
    <x-slot:title>Ruang Kelas</x-slot:title>
    
    <div class="container">
        <div class="card">
            <div class="card-header">Ruang Kelas</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{route('ruangkelas.create')}}" class="btn btn-primary">Data Baru</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Data</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <th>#</th>
                                <th>Lokasi</th>
                                <th>Kode Ruangan</th>
                            </thead>
                            <tbody>
                                @if (isset($ruangkelas))
                                    @foreach ($ruangkelas as $kelas)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>
                                            @if ($kelas->lokasi == 'kampus_utama')
                                            Kampus Utama (Panam)
                                            @else
                                            Kampus Sukajadi
                                            @endif
                                        </td>
                                        <td>
                                            {{$kelas->kode}}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>No Data</tr>    
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>