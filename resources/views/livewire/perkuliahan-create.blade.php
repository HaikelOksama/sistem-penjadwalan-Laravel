<div>
    <form wire:submit.prevent="create">
            <div class="form-group">
                <label for="nama">Tahun</label>
                <input wire:change="resetDosen" wire:model.lazy="tahun" value="{{old('tahun')}}" required class="form-control" type="text" name="tahun" placeholder="Tahun Perkuliahan">
                @error('tahun')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <div class="form-group">
                <label for="nama">Semester</label>
                <select wire:change="resetDosen" wire:model="semester" required class="form-select" name="semester">
                    <option readonly selected>Pilih Semester</option>
                    @for ($i = 1; $i < 9; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                @error('semester')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <div class="form-group">
                <label for="matkul">Ruangan Kelas</label>
                <select required  wire:change="resetDosen" wire:model="ruangan" class="form-select" name="kelas" id="">
                    <option readonly selected aria-readonly>Pilih Ruangan Kelas</option>
                    <option disabled>---Kampus Utama---</option>
                    @foreach ($kelasUtama as $kelas)
                        <option value="{{$kelas->id}}">{{$kelas->kode}}</option>
                    @endforeach
                    <option disabled>---Kampus Sukajadi---</option>
                    @foreach ($kelasSukajadi as $kelas)
                        <option value="{{$kelas->id}}">{{$kelas->kode}}</option>
                    @endforeach
                </select>
                @error('ruangan')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <div class="form-group">
                <label for="matkul">Hari</label>
                <select required  wire:change="resetDosen" wire:model="hari" class="form-select" name="hari" id="">
                    <option readonly selected >Pilih Hari</option>
                    <option value="senin">Senin</option>
                    <option value="selasa">Selasa</option>
                    <option value="rabu">Rabu</option>
                    <option value="kamis">Kamis</option>
                    <option value="jumat">Jumat</option>
                    <option value="sabtu">Sabtu</option>
                </select>
                @error('hari')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <div class="form-group mt-0 mb-3 border rounded p-3">
                <label for="waktu">Waktu Dimulai</label>
                <input required 
                @if (!$cekWaktu)
                disabled = ''    
                @endif
                wire:change="resetDosen" wire:model="waktu" value="{{old('waktu')}}" class="form-control-sm" type="time" name="waktu" id="">
            
                <label for="waktu">Waktu Berakhir</label>
                <input 
                required 
                @if (!$cekWaktu)
                disabled = ''    
                @endif
                wire:model="berakhir" wire:change="timeSelected" value="{{old('berakhir')}}" class="form-control-sm" type="time" name="berakhir" id="">
                <br>
                @if ($message == 'available')
                    <p class="text-success">Ruangan Dapat Digunakan!</p>
                @elseif ($message == 'time-error')
                    <code>Waktu yang dipilih Tidak Valid</code>
                @elseif($message == 'not-available')
                    <p class="text-danger mb-0">Ruangan Tidak Dapat Digunakan! detil :</p>
                @endif
                
                @error('waktu')
                    <code>{{$message}}</code>
                @enderror
                @error('berakhir')
                    <code>{{$message}}</code>
                @enderror

                @if ($ruanganDipakai != null)
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <th>Nama Dosen</th>
                                <th>Matakuliah</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$ruanganDipakai['dosen']->nama}}</td>
                                    <td>{{$ruanganDipakai['matakuliah']->nama}}</td>
                                    <td>{{$ruanganDipakai['perkuliahan']->semester}}</td>
                                    <td>{{$ruanganDipakai['perkuliahan']->kelas}}</td>
                                    <td>{{$ruanganDipakai['perkuliahan']->hari}}</td>
                                    <td>{{$ruanganDipakai['perkuliahan']->waktu}}</td>
                                    <td>{{$ruanganDipakai['perkuliahan']->berakhir}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="matkul">Dosen</label>
                <select 
                @if (!$cekRuangan)
                    disabled = ''
                @endif
                wire:model="classdosen" wire:change="dosenSelected" 
                class="form-select selectpicker" 
                name="dosen" id="">
                    <option selected readonly>Pilih Dosen</option>
                    @foreach ($dosen as $dosen)
                        <option value="{{$dosen->id}}">{{$dosen->nama}}</option>
                    @endforeach
                </select>
                @error('classdosen')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <div class="form-group">
                <label for="matkul">Matakuliah</label>
                <select 
                @if (!$cekRuangan)
                disabled = ''
                @endif
                wire:model="classmatakuliah" class="form-select" name="matakuliah" id="">
                    <option readonly selected>Pilih Matakuliah</option>
                    @if ($matakuliah != null)
                        @foreach ($matakuliah as $matkul)
                            <option value="{{$matkul['id']}}">{{$matkul['nama']}}</option>
                        @endforeach
                    @endif
                </select>
                @error('classmatakuliah')
                    <code>{{$message}}</code>
                @enderror
            </div>
            <button
            @if (!$cekRuangan)
                disabled = ''    
            @endif
            type="submit" class="mt-2 btn btn-success">Simpan</button>
        </form>
</div>
