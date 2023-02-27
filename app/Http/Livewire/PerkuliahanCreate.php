<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Livewire\Component;

class PerkuliahanCreate extends Component
{
    public $tahun;
    public $semester;
    public $ruangan;
    public $hari;
    public $waktu;
    public $berakhir;
    public $kelas;
    
    public $classdosen;
    public $classmatakuliah;

    public $matakuliah;
    public $message;

    public $ruanganDipakai;

    public $cekRuangan = false;
    public $cekWaktu = false;

    public function render()
    {   

        if($this->tahun && $this->semester && $this->ruangan && $this->hari != null){
            $this->cekWaktu = true;
        } else {
            $this->cekWaktu = false;
        }

        $kelas = RuangKelas::all();
        $kelasUtama = RuangKelas::where('lokasi' , '=', 'kampus_utama')->get();
        $kelasSukajadi = RuangKelas::where('lokasi' , '!=', 'kampus_utama')->get();
        // dd(["kampus utama" => $kelasUtama, "kampus sukajadi" => $kelasSukajadi]);
        $dosen = Dosen::all();
        return view('livewire.perkuliahan-create', [
            'kelas' => $kelas, 
            'dosen' => $dosen,
            'kelasUtama' => $kelasUtama,
            'kelasSukajadi' => $kelasSukajadi
        ]);
    }

    public function dosenSelected(){
        $dosen = Dosen::find($this->classdosen);
        if($dosen != null) {
            $matkul = $dosen->matakuliah->all();
            $this->matakuliah = $matkul;
        } else {
            $this->matakuliah = null;
        }
    }

    public function timeSelected() {
        $tahun = $this->tahun;
        $ruangan = $this->ruangan;
        $hari = $this->hari;
        $mulai = $this->waktu;
        $akhir = $this->berakhir;


        $this->ruanganDipakai = null;

        $exist = $this->cekRuangan($tahun, $ruangan,  $hari, $mulai, $akhir);
        if($exist == null){
            if($mulai > $akhir || $mulai == $akhir){
                $this->message = 'time-error';
                $this->cekRuangan = false;

            } else {
                $this->message = 'available';
                $this->cekRuangan = true;
            }
        } else {
            $this->message = 'not-available';
            $this->cekRuangan = false;
            // dd($exist);
            $ruangDipakai = $exist->getDosenMatakuliah($exist->id_dosen_matakuliah); // method on perkuliahan model
            // dd($ruangDipakai);
            $ruangDipakai = $ruangDipakai->getDosenMatakuliah($ruangDipakai->dosen_id, $ruangDipakai->matakuliah_id); //method on dosen_matakuliah model
            // dd($ruangDipakai['dosen']->nip);
            // dd($ruangDipakai['matakuliah']);
            $this->ruanganDipakai = $ruangDipakai;
            $this->ruanganDipakai['perkuliahan'] = $exist;
        }
        
    }

    public function resetDosen() {
        $this->ruanganDipakai = null;
        $this->berakhir = null;
        $this->message = '';
        $this->cekRuangan = false;
    }

    private function cekRuangan($tahun , $ruangan, $hari, $mulai, $akhir) {
        try {
            $perkuliahan = Perkuliahan::where('tahun','=', $tahun)
                        ->where('id_kelas','=', $ruangan)
                        ->where('hari', '=', $hari)
                        ->whereRaw('TIME(waktu) <= ? and TIME(berakhir) >= ?', [$akhir ,$mulai])
                        ->first();
                        // ->whereRaw('TIME(waktu) between ? and ?', [$mulai, $akhir])
                        // ->whereRaw('TIME(waktu) between ? and ?', [$mulai, $akhir])
                        // ->orWhereRaw('TIME(berakhir) between ? and ?', [$mulai, $akhir])
                        // ->exists();
        } catch (\Throwable $th) {
            $perkuliahan = null;
        }
        
        return $perkuliahan;
    }

    public function create(){
        $tahun = $this->tahun;
        $semester = $this->semester;
        $ruangan = $this->ruangan;
        $hari = $this->hari;
        $mulai = $this->waktu;
        $akhir = $this->berakhir;
        $dosenId = $this->classdosen;
        $matakuliahId = $this->classmatakuliah;

        $getDosen = Dosen::find($dosenId);
        $input = $this->validate([
            'hari' => 'required',
            'waktu' => 'required|date_format:H:i',
            'berakhir' => 'required|date_format:H:i|after:waktu',
            'tahun' => 'required|numeric|digits:4',
            'semester' => 'required|max:3',
            'kelas' => 'required|max:2',
            'ruangan' => 'required',
            'classdosen' => 'required',
            'classmatakuliah' => 'required',
        ]);
        
        $getMatkulDosen = $getDosen->matakuliah->find($matakuliahId);
        $input['id_kelas'] = $ruangan;
        $input['id_dosen_matakuliah'] = $getMatkulDosen->id;
        $input['kelas'] = 'G';

        Perkuliahan::create($input);

        return redirect()->route('perkuliahan.index');
        // Perkuliahan::create([
        //     'id_kelas' => $ruangan,
        //     'id_dosen_matakuliah' => $getMatkulDosen,
        //     'hari' => $hari,
        //     'waktu' => $mulai,
        //     'berakhir' => $akhir,
        //     'tahun' => $tahun,
        //     'semester' => $semester,
        //     'kelas' => 'G'
        // ]);

        

    }
}
