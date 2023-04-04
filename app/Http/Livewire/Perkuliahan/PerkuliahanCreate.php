<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Dosen;
use App\Models\DosenMatakuliah;
use App\Models\Matakuliah;
use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Carbon\Carbon;
use Livewire\Component;

class PerkuliahanCreate extends Component
{
    public $tahun;
    public $ajaran;
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

    public $sks;

    protected $listeners = [
        'matakuliahChange' => 'handleMatakuliah',
        'waktuChange' => 'handleWaktu'
    ];

    public function mount(){
        $this->tahun = date('Y');
        $currMonth = Carbon::now()->month;
        $currYear = Carbon::now()->year;
        $this->tahun = $currYear;
        if ($currMonth >= 6 || $currMonth < 2) {
            $this->ajaran = 'ganjil';
        } else {
            $this->ajaran = 'genap';
        }
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
        if(isset($this->waktu)){
            $time = $this->waktu;
            $fullTime = Carbon::createFromFormat('H:i', $time);
            $fullTime->addMinutes($this->sks * 50);
            $this->berakhir = $fullTime->format('H:i');
            $exist = $this->cekRuangan($this->tahun,$this->ajaran, $this->ruangan,  $this->hari, $time, $fullTime);
        
            if($exist == null){
                    $this->message = 'available';
                    $this->cekRuangan = true;
                }
            else {
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
    }
    

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
        $perkuliahanExist = Perkuliahan::all();
        return view('livewire.perkuliahan.perkuliahan-create', [
            'kelas' => $kelas, 
            'dosen' => $dosen,
            'kelasUtama' => $kelasUtama,
            'kelasSukajadi' => $kelasSukajadi,
            'perkuliahanExist' => $perkuliahanExist,
        ]);
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
        // dd($getDosen);
        $input = $this->validate([
            'hari' => 'required',
            'waktu' => 'required|date_format:H:i',
            'berakhir' => 'required|date_format:H:i|after:waktu',
            'tahun' => 'required|numeric|digits:4',
            'semester' => 'required|max:3',
            'ajaran' => 'required',
            'kelas' => 'required',
            'ruangan' => 'required',
            'classdosen' => 'required',
            'classmatakuliah' => 'required',
        ]);
    
        
        $getMatkulDosen = $getDosen->matakuliah->find($matakuliahId)->toArray();
        $dosMat = DosenMatakuliah::where('dosen_id' , $dosenId)->where('matakuliah_id', $matakuliahId)->first();
        // dd($dosMat);
        // dd($getMatkulDosen['id']);    
        // $input['id_kelas'] = $ruangan;
        // $input['id_dosen_matakuliah'] = $getMatkulDosen->id;
        
        // dd($input);
        $instance = Perkuliahan::create([
            'id_kelas' => $ruangan,
            'id_dosen_matakuliah' => $dosMat->id,
            'hari' => $input['hari'],
            'waktu' => $input['waktu'],
            'berakhir' => $input['berakhir'],
            'tahun' => $input['tahun'],
            'semester' => $input['semester'],
            'kelas' => $input['kelas'],
        ]);
        $this->emit('created', $instance);
        return redirect()->route('perkuliahan.index');
        
    }
}
