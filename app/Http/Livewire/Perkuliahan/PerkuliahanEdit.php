<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Carbon\Carbon;
use Livewire\Component;

class PerkuliahanEdit extends Component
{
    public $perkuliahan;

    public $tahun;
    public $ajaran;
    public $semester;
    public $ruangan;
    public $hari;
    public $waktu;
    public $berakhir;
    public $kelas;

    public $dosen;
    public $classdosen;
    
    public $matakuliah;
    public $classmatakuliah;

    public $ruanganDipakai;
    
    public $message;
    public $cekRuangan = false;
    public $cekWaktu = false;

    public $sks;

    protected $listeners = [
        'matakuliahChange' => 'handleMatakuliah',
        'waktuChange' => 'handleWaktu'
    ];

    public function mount($id){
        $perkuliahan = Perkuliahan::find($id);
        $this->perkuliahan = $perkuliahan->id;
        // dd($perkuliahan);
        $this->tahun = $perkuliahan->tahun;
        $this->ajaran = $perkuliahan->ajaran;
        $this->semester = $perkuliahan->semester;
        $this->ruangan = $perkuliahan->ruangan;
        $this->kelas = $perkuliahan->kelas;
        $this->hari = $perkuliahan->hari;
        $this->classdosen = $perkuliahan->getDosenMatakuliah($perkuliahan->id_dosen_matakuliah)->dosen->id;
        $this->classmatakuliah = $perkuliahan->getDosenMatakuliah($perkuliahan->id_dosen_matakuliah)->matakuliah->id;
        $this->waktu = $perkuliahan->waktu;
        $this->berakhir = $perkuliahan->berakhir;
        $this->ruangan = $perkuliahan->id_kelas;

        $matakuliah = Matakuliah::find($this->classmatakuliah);
        $this->sks = $matakuliah->sks;
    }
    
    public function render()
    {

        if($this->tahun && $this->semester && $this->ruangan && $this->hari != null){
            $this->cekWaktu = true;
        } else {
            $this->cekWaktu = false;
        }

        $getDosen = Dosen::find($this->classdosen);
        $this->matakuliah = $getDosen->matakuliah->all();
        
        $this->dosen = Dosen::all();
        $kelasUtama = RuangKelas::where('lokasi' , '=', 'kampus_utama')->get();
        $kelasSukajadi = RuangKelas::where('lokasi' , '!=', 'kampus_utama')->get();
        return view('livewire.perkuliahan.perkuliahan-edit' , [
            'kelasUtama' => $kelasUtama,
            'kelasSukajadi' => $kelasSukajadi,
            'pekuliahanExist' => Perkuliahan::all(),
        ]);
    }

    public function handleMatakuliah(){
        $this->ruanganDipakai = null;
        // $this->waktu = null;
        $this->message = null;
        $this->berakhir = null;
        if($this->classmatakuliah != null){
            try {
                $matkul = Matakuliah::find($this->classmatakuliah)->sks;
                $this->sks = $matkul;
                $this->handleWaktu();
            } catch (\Throwable $th) {
                $this->sks = null;
            }
        }
    }


    public function handleWaktu() {
        $this->ruanganDipakai = null;
        $perkuliahan = Perkuliahan::find($this->perkuliahan);
        if(isset($this->waktu)){
            $time = $this->waktu;
            $time = substr($time, 0, 5);
            $fullTime = Carbon::createFromFormat('H:i', $time);
            $fullTime->addMinutes($this->sks * 50);
            $this->berakhir = $fullTime->format('H:i');
            $exist = $this->cekRuangan($this->tahun,$this->ajaran, $this->ruangan,  $this->hari, $time, $fullTime);
           
            if($exist == null){
                    $this->message = 'available';
                    $this->cekRuangan = true;
                }
            else if($exist == $perkuliahan){
                    $this->message = 'available';
                    $this->cekRuangan = true;
            }
            else {
                $this->message = 'not-available';
                $this->cekRuangan = false;

                $ruangDipakai = $exist->getDosenMatakuliah($exist->id_dosen_matakuliah); // method on perkuliahan model

                $ruangDipakai = $ruangDipakai->getDosenMatakuliah($ruangDipakai->dosen_id, $ruangDipakai->matakuliah_id); //method on dosen_matakuliah model
                $this->ruanganDipakai = $ruangDipakai;
                $this->ruanganDipakai['perkuliahan'] = $exist;
            }
        } 
    }

    private function cekRuangan($tahun , $ajaran, $ruangan, $hari, $mulai, $akhir) {
        try {
            $perkuliahan = Perkuliahan::where('tahun','=', $tahun)
                        ->where('ajaran', '=', $ajaran)
                        ->where('id_kelas','=', $ruangan)
                        ->where('hari', '=', $hari)
                        ->whereRaw('TIME(waktu) < ? and TIME(berakhir) > ?', [$akhir ,$mulai])
                        ->first();
        } catch (\Throwable $th) {
            $perkuliahan = null;
        }
        
        return $perkuliahan;
    }

    public function dosenSelected(){
        $this->sks = null;
        $dosen = Dosen::find($this->classdosen);
        if($dosen != null) {
            $matkul = $dosen->matakuliah->all();
            $this->matakuliah = $matkul;
        } else {
            $this->matakuliah = null;
        }
        $this->handleMatakuliah();
    }

    public function timeSelected() {
        $tahun = $this->tahun;
        $ruangan = $this->ruangan;
        $hari = $this->hari;
        $mulai = $this->waktu;
        $akhir = $this->berakhir;
        $ajaran = $this->ajaran;

        $this->ruanganDipakai = null;

        $exist = $this->cekRuangan($tahun,$ajaran, $ruangan,  $hari, $mulai, $akhir);
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

    public function update(){
        $time = $this->waktu;
        $time = substr($time, 0, 5);
        $this->waktu = $time;

        $fullTime = Carbon::createFromFormat('H:i', $time);
        $fullTime->addMinutes($this->sks * 50);
        $this->berakhir = $fullTime->format('H:i');

        $input = $this->validate([
            'hari' => 'required',
            'ajaran' => 'required',
            'waktu' => 'required|date_format:H:i',
            'berakhir' => 'required|date_format:H:i|after:waktu',
            'tahun' => 'required|numeric|digits:4',
            'semester' => 'required|max:3',
            'kelas' => 'required',
            'ruangan' => 'required',
            'classdosen' => 'required',
            'classmatakuliah' => 'required',
        ]);

        $curr = Perkuliahan::find($this->perkuliahan);
        $curr->update($input);
        return redirect()->route('perkuliahan.index')->with('success', $curr);
    }
}
