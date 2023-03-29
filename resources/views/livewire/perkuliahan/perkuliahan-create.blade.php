<div>
    <div class="card card-outline card-primary">
    <div class="card-header">
        <h2 class="card-title">Perkuliahan Baru</h2>
    </div>
    <div class="card-body ">
        <form wire:submit.prevent="create">
                <div class="form-group">
                    <label for="nama">Tahun Ajaran</label>
                    <div class="row pl-2">
                        <input wire:change="$emit('matakuliahChange')" wire:model.lazy="tahun" value="{{ date('Y') }}" 
                        required class="form-control col-3" type="text" name="tahun" placeholder="Tahun Perkuliahan">
                        <select wire:change="$emit('matakuliahChange')" required wire:model="ajaran.lazy" class="form-control col-3">
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>
                    @error('tahun')
                        <code>{{$message}}</code>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Semester</label>
                    <select wire:model="semester" required class="form-control" name="semester">
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
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" wire:model="kelas">
                </div>
                <div class="form-group">
                    <label for="matkul">Ruangan Kelas</label>
                    <select required  wire:change="$emit('matakuliahChange')" wire:model="ruangan" class="form-control" name="kelas" id="">
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
                    <select required  wire:change="$emit('matakuliahChange')" wire:model="hari" class="form-control" name="hari" id="">
                        <option readonly selected >Pilih Hari</option>
                        <option value="1">Senin</option>
                        <option value="2">Selasa</option>
                        <option value="3">Rabu</option>
                        <option value="4">Kamis</option>
                        <option value="5">Jumat</option>
                        <option value="6">Sabtu</option>
                    </select>
                    @error('hari')
                        <code>{{$message}}</code>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="matkul">Dosen</label>
                    <select 
                    {{-- @if (!$cekRuangan)
                        disabled = ''
                    @endif --}}
                    wire:model="classdosen" wire:change="dosenSelected" 
                    class="form-control selectpicker" 
                    name="dosen" id="">
                        <option value="0">Pilih Dosen</option>
                        @foreach ($dosen as $item)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                    @error('classdosen')
                        <code>{{$message}}</code>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="matkul">Matakuliah</label>
                    <select
                    aria-placeholder="Pilih Matakuliah"
                    @if (!isset($classdosen) || $classdosen == 0)
                    disabled = ''
                    @endif
                    wire:model="classmatakuliah" class="form-control" name="matakuliah" id=""
                    wire:change="$emit('matakuliahChange')"
                    >
                        <option value="0" >Pilih Matakuliah</option>
                        @if ($matakuliah != null)
                            @foreach ($matakuliah as $matkul)
                                <option value="{{$matkul['id']}}">{{$matkul['nama']}} - {{$matkul['sks']}} SKS</option>
                            @endforeach
                        @endif
                    </select>
                    @error('classmatakuliah')
                        <code>{{$message}}</code>
                    @enderror
                </div>
                <div class="form-group mt-0 mb-3 border rounded p-3">
                    <legend> 
                        @if (isset($sks))
                        {{$sks}} SKS
                        @endif
                    </legend>
                    <label for="waktu">Waktu Dimulai</label>
                    <input required 
                    @if (!isset($sks))
                    disabled = ''    
                    @endif
                    {{-- wire:change="resetDosen"  --}}
                    wire:model="waktu" 
                    wire:change="$emit('waktuChange')"
                    value="{{old('waktu')}}" class="form-control" type="time" name="waktu" id="time-picker">
                    <label for="waktu">Waktu Berakhir</label>
                    <strong>
                        @if (isset($berakhir))
                        {{$berakhir}}
                            
                        @endif
                    </strong>
                    {{-- <input 
                    required 
                    {{-- @if (!$cekWaktu)
                    disabled = ''    
                    @endif --}}
                    {{-- wire:model="berakhir" wire:change="timeSelected" 
                    value="{{old('berakhir')}}" class="form-control" type="time" name="berakhir" id=""> --}}
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
                                        <td>{{$ruanganDipakai['perkuliahan']->getDayName()}}</td>
                                        <td>{{$ruanganDipakai['perkuliahan']->waktu}}</td>
                                        <td>{{$ruanganDipakai['perkuliahan']->berakhir}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    @endif
                </div>
                
                <button
                @if (!$cekRuangan)
                    disabled = ''    
                @endif
                type="submit" class="mt-2 btn btn-success">Simpan</button>
            </form>
        </div>

    </div>
        <x-slot:script>
           
        </x-slot:script>
</div>
