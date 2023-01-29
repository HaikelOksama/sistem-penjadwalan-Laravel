<x-layout>
    <x-slot:title>Matakuliah</x-slot:title>
    
    <div class="container">
        <div class="card">
            <div class="card-header">Matakuliah</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="{{route('matakuliah.create')}}" class="btn btn-primary">Data Baru</a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Data</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @if (isset($matakuliah))
                                @foreach ($matakuliah as $matakuliah)
                                <li class="list-group-item">{{$matakuliah->nama}}</li>                         
                                @endforeach
                            @else
                                <li class="list-group-item">No Data</li>    
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>