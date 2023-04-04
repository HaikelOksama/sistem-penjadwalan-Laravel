<?php

namespace App\Http\Livewire\Perkuliahan;

use App\Models\Perkuliahan;
use App\Models\RuangKelas;
use Livewire\Component;

class AvailableTime extends Component
{
    public $tahun;
    public $semester;
    public $hari;
    public $ruangan;

    public function mount(){

        $this->tahun = 2023;
        $this->hari = 1;
        $this->ruangan = 1;
        // $this->fillPerkuliahan($this->tahun);
    }

    public function render()
    {   
        $timeSlots = [
            '07:30-08:20' => ['available'=>true],
            '08:20-09:10' => ['available'=>true],
            '09:10-10:00' => ['available'=>true],
            '10:00-10:50' => ['available'=>true],
            '10:50-11:40' => ['available'=>true],
            '11:40-12:30' => ['available'=>true],
            '12:30-13:00' => ['available'=>true],
            '13:00-13:50' => ['available'=>true],
            '13:50-14:40' => ['available'=>true],
            '14:40-15:30' => ['available'=>true],
            '15:30-16:20' => ['available'=>true],
            '16:20-17:10' => ['available'=>true],
            '17:10-18:00' => ['available'=>true],
        ];

        $ruangan = RuangKelas::find($this->ruangan);
        $perkuliahan = Perkuliahan::where('tahun', $this->tahun)
                        ->where('hari', $this->hari)
                        ->where('ajaran', $this->semester ?? 'ganjil')
                        ->where('id_kelas', $this->ruangan)->get();
        
        $listRuangan = RuangKelas::orderBy('lokasi', 'asc')
                        ->orderBy('kode', 'asc')->get();

        foreach($timeSlots as $timeSlot => $idx){
            $start = substr($timeSlot, 0, 5);
            $end = substr($timeSlot, 6);

            foreach($perkuliahan as $data) {
                $awal = substr($data->waktu, 0, 5);
                $berakhir = substr($data->berakhir, 0 , 5);
                $matakuliah = $data->getDosenMatakuliah($data->id_dosen_matakuliah)->matakuliah->nama;
                $dosen = $data->getDosenMatakuliah($data->id_dosen_matakuliah)->dosen->nama;
                $semester = $data->semester;
                $ruangan = RuangKelas::find($data->id_kelas);
                // dd($awal . '' . $berakhir);
                if($start >= $awal && $end <= $berakhir) {
                    $timeSlots[$timeSlot]['available'] = false;
                    $timeSlots[$timeSlot]['ruangan'] = $ruangan->kode;
                    $timeSlots[$timeSlot]['matakuliah'] = $matakuliah;
                    $timeSlots[$timeSlot]['dosen'] = $dosen;
                    $timeSlots[$timeSlot]['semester'] = $semester;
                }
            }
        }
        // It Works Now
        // TODO: Working on frontend to display time slots and some dynamic data

        

        return view('livewire.perkuliahan.available-time', [
            'perkuliahan' => $perkuliahan, 'timeSlots' => $timeSlots, 'listRuangan' => $listRuangan,]);
    }

    public function jadwalKuliah($year, $batch = 'ganjil') {
        $timeSlots = [
            '07:30-08:20' => ['available'=>true],
            '08:20-09:10' => ['available'=>true],
            '09:10-10:00' => ['available'=>true],
            '10:00-10:50' => ['available'=>true],
            '10:50-11:40' => ['available'=>true],
            '11:40-12:30' => ['available'=>true],
            '12:30-13:00' => ['available'=>true],
            '13:00-13:50' => ['available'=>true],
            '13:50-14:40' => ['available'=>true],
            '14:40-15:30' => ['available'=>true],
            '15:30-16:20' => ['available'=>true],
            '16:20-17:10' => ['available'=>true],
            '17:10-18:00' => ['available'=>true],
        ];

        $ruangan = RuangKelas::select('id', 'kode')
                ->orderBy('lokasi', 'desc')->orderBy('kode', 'asc')->get();
        // dd($ruangan);

        $perkuliahan = collect([
            'tahun' => $year,
            'ajaran' => $batch,
            'ruangan' => collect([])
        ]);
        
        foreach ($ruangan as $ruang ) {
            $perkuliahan->get('ruangan')->push([
                'id' => $ruang->id,
                'kode' => $ruang->kode,
                'hari' => collect([
                    0=> collect([]),
                    1=> collect([]),
                    2=> collect([]),
                    3=> collect([]),
                    4=> collect([]),
                    5=> collect([]),
                    6=> collect([])
                ])
            ]);
        
        }
        $ruang = $perkuliahan->get('ruangan');
        // dd($ruang);
        foreach($ruang as $data => $key) {
            $value = collect($ruang->get($data));
            $hari = $value->get('hari');
            foreach($hari as $dataHari => $key) {
                $instance = collect($hari);
                $instance->get($dataHari)->put('jadwal', $timeSlots);
            }
            
        }

        $dataKuliah = Perkuliahan::where('tahun', $this->tahun)->where('ajaran', $batch);

        $ruang->each(function(&$ruang) use ($dataKuliah){
            $kuliah = $dataKuliah->where('id_kelas', $ruang['id']);

            foreach($ruang['hari'] as $hari => $key) {
                $data = $kuliah->where('hari', $hari)->get();
                
                foreach($key as $jadwal) {
                    
                    foreach($jadwal as $waktu => $status) {
                            foreach($data as $kuliah) {
                                dd($kuliah);
                            }
                    }
                }
            }
            
            $ruang['hari']->each(function(&$hari, &$key) use ($kuliah){
                $kuliahHari = $kuliah->where('hari', $key)->get();
                collect($hari['jadwal'])->each(function(&$status, $time){
                    
                });
            });
        });

        dd($ruang);
        // //this reference to the top foreach , modify it  by getting $hari 
        // foreach($ruang as $data => $key) {
        //     $value = collect($ruang->get($data));
        //     $hari = $value->get('hari');
        //     foreach($hari as $dataHari => $key) {
        //         $instance = collect($hari);
                
        //         foreach($instance as $data => $value) {
        //             $waktu = collect($value)->get('jadwal');
        //             // dd($waktu);
        //             foreach($waktu as $slot => $key) {
        //                 $start = substr($slot, 0, 5);
        //                 $end = substr($slot, 6);
                        
        //                 foreach($modelPerkuliahan as $data) {
        //                     $awal = substr($data->waktu, 0, 5);
        //                     $berakhir = substr($data->berakhir, 0 , 5);
        //                     $matakuliah = $data->getDosenMatakuliah($data->id_dosen_matakuliah)->matakuliah->nama;
        //                     $dosen = $data->getDosenMatakuliah($data->id_dosen_matakuliah)->dosen->nama;
        //                     $semester = $data->semester;
        //                     $ruangan = RuangKelas::find($data->id_kelas);
        //                     if($start >= $awal && $end <= $berakhir) {
        //                         $collect = collect($waktu)->get($slot);
        //                         $collect = collect($collect)->put('available', false);
        //                         $collect = collect($collect)->put('matakuliah', $matakuliah);
        //                         $collect = collect($collect)->put('dosen', $dosen);
        //                         $collect = collect($collect)->put('semester', $semester);
        //                     }
        //                 }
        //             }
        //         };
                
        //     }
            
        // } 
        return $perkuliahan;
    }

    public function fillPerkuliahan($tahun, $batch ="ganjil") {

        $modelPerkuliahan = Perkuliahan::where('tahun', $tahun)
                    ->where('ajaran', $batch);

        $data = $this->jadwalKuliah($tahun, $batch);
        $jadwal = $data->get('ruangan');
        $jadwal->each(function(&$data, $key) use($modelPerkuliahan){
            $modelKuliah = $modelPerkuliahan->where('id_kelas', $data['id']); 
            $data['hari']->each(function(&$hari, $key) use ($modelKuliah){
                $model = $modelKuliah->where('hari', strval($key))->get();
                collect($hari['jadwal'])->each(function(&$data, $waktu) use ($model){
                    $start = substr($waktu, 0, 5);
                    $end = substr($waktu, 6);
                    collect($data['available'])->transform(function ($item, $key){
                        return 'asdasd';
                    }); 
                });
            });
        });
        // $waktuKuliah = $jadwal->each(function(&$item, $key) use (&$modelPerkuliahan) {
        //     $hari = $item['hari'];
        //     $idKelas = $item['id'];
        //     $perkuliahan = $modelPerkuliahan->where('id_kelas', $idKelas);
        //     // dd($perkuliahan->get());
        //     foreach($hari as $kodeHari => $data) {
        //         $kode = strval($kodeHari);
        //         $dataKuliah = $perkuliahan->where('hari', '=', $kode)->get();
        //         $jadwal = $data['jadwal'];
        //         if($dataKuliah->count() != 0){
        //             dd('yse');
        //             collect($jadwal)->each(function(&$value, $slot) use (&$dataKuliah){
        //                 $start = substr($slot, 0,5);
        //                 $end = substr($slot, 6);
        //                 foreach($dataKuliah as $data) {
        //                     $hari = $data->hari;
        //                     dd($hari);
        //                     $mulai = $data->waktu;
        //                     $akhir = $data->berakhir;
        //                     if($start >= $mulai && $end <= $akhir) {
                                
        //                     }
        //                 }
        //             });
                    
        //         }
        //     }
        // });


        // foreach($jadwal as $key=>$data) {
        //     // $hari = collect($data['hari'])->map(function ($item , $key){
        //     //     return collect($item['jadwal']);
        //     // });
        //     $hari = collect($jadwal)->get($key);
        //     $hari = collect($hari)->get('hari');
      
        //     foreach($hari as $waktu => $val) {
        //         dd($waktu);
        //         foreach($val as $sesi => $data) {
        //             $start = substr($sesi, 0,5);
        //             $end = substr($sesi, 6);
        //             $availability = collect($data)->get('available');

        //             foreach($modelPerkuliahan as $kuliah) {
        //                 $awal = substr($kuliah->waktu, 0,5);
        //                 $berakhir = substr($kuliah->berakhir, 0,5);
                        
        //                 if($start >= $awal && $end <= $berakhir) {
        //                     collect($data)->put('available', false);
                            
        //                     // $collect = collect($collect)->put('matakuliah', $matakuliah);
        //                     // $collect = collect($collect)->put('dosen', $dosen);
        //                     // $collect = collect($collect)->put('semester', $semester);
        //                 }
        //             }
                    
        //         }
        //     }
        // }

        dd($jadwal);

    }

}
