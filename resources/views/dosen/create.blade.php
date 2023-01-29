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
                        <label for="matkul">Mata Kuliah Diampu</label>
                        <select class="form-select" name="matkul[]" id="" multiple>
                            @foreach ($matakuliah as $matkul)
                                <option value="{{$matkul->id}}">{{$matkul->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="mt-2 btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>