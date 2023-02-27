<x-layout>
    <x-slot:title>Ruangan Baru</x-slot:title>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Ruangan Baru</h3>
            </div>
            <div class="card-body">
                <form action="{{route('ruangkelas.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="nama">Kode</label>
                        <input required class="form-control" type="text" name="kode" placeholder="Kode Ruangan">
                        @error('kode')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <select required name="lokasi" id="" class="form-select">
                            <option value="kampus_utama">Kampus Utama (Panam)</option>
                            <option value="kampus_sukajadi">Kampus Sukajadi</option>
                        </select>
                        @error('lokasi')
                            <code>{{$message}}</code>
                        @enderror
                    </div>
                    <button type="submit" class="mt-2 btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>


</x-layout>