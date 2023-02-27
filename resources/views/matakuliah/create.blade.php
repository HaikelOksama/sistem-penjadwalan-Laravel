<x-layout>
    <x-slot:title>Matakuliah Baru</x-slot:title>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Matakuliah Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{route('matakuliah.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input value={{old('nama')}} required class="form-control" type="text" name="nama" placeholder="Nama matakuliah">
                        @error('nama')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Kode</label>
                        <input value={{old('kode')}} required class="form-control" type="text" name="kode" placeholder="Kode">
                        @error('kode')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <button type="submit" class="mt-2 btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>

</x-layout>