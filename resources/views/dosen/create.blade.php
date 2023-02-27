<x-layout>
    <x-slot:title>Dosen Baru</x-slot:title>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Dosen Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{route('dosen.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required class="form-control" type="text" name="nama" placeholder="Nama lengkap dengan gelar">
                        @error('nama')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">NIP</label>
                        <input required class="form-control" type="text" name="nip" placeholder="NIP">
                        @error('nip')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <div class="form-group">
                        <legend>Mata Kuliah Diampu</legend>
                        <div class="d-flex gap-3 px-3 flex-wrap">
                        @foreach ($matakuliah as $matkul)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="matkul[]" id="" value="{{$matkul->id}}">
                            <label class="form-check-label" for="">{{$matkul->nama}} | </label>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    <button type="submit" class="mt-2 btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>