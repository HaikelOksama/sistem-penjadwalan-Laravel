<?php

namespace App\Http\Livewire\Dosen;

use App\Models\Dosen;
use App\Models\Matakuliah;
use Livewire\Component;

class DosenCreate extends Component
{
    public $nama;
    public $nip;
    public $inisial;
    public $matakuliahInput = [];
    public $matakuliahList = [];
    public $dismissState;

    protected $listeners = [
        'select2Changed' => 'handleSelectChanged',
    ];

    public function mount() {
        $this->matakuliahList = Matakuliah::orderBy('nama', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.dosen.dosen-create');
    }

    public function handleSelectChanged($val) {
        $this->matakuliahInput = $val;
    }

    public function generateInisial(){
        // Sample input string with title
        $name = $this->nama ?? '';

        // Regular expression to match and extract the name
        $pattern = '/\b(?:\p{Lu}\p{Ll}*\s+)+\p{Lu}\p{Ll}*\b/';
        preg_match($pattern, $name, $matches);

        // Extracted full name without title
        try {
            $full_name = $matches[0];
        } catch (\Throwable $th) {
            $full_name = '';
            $this->inisial = '';
            return ;
        }

        // Print the result
        // Split the full name into separate words
        $words = explode(" ", $full_name);

        // Initialize an empty string for the initials
        $initials = "";

        if (count($words) === 1) {
            $initials = substr($words[0], 0, 3);
        } else {
            // If there are multiple words, add the first letter of each to the initials
            foreach ($words as $word) {
                $initials .= substr($word, 0, 1);
            }
        
            // If the initials are less than three letters, add the first non-initial letter
            if (strlen($initials) < 3) {
                for ($i = 1; $i < count($words); $i++) {
                    $last_name = $words[$i];
                    $initials .= strtoupper(preg_replace('/\b[A-Za-z]*([A-Za-z])[A-Za-z]*/', '$1', $last_name))[0];
        
                    if (strlen($initials) >= 3) {
                        break;
                    }
                }
            }
        }
        $this->inisial = $initials;
        // dd($initials);
    }

    public function store(){
        $input = $this->validate([
            'nama' => 'required',
            'inisial' => 'required|max:5',
            'nip' => 'required|numeric',
            'matakuliahInput' => 'required|array',
        ]);
        // dd($input['matakuliahInput']);
        
        $dosen = Dosen::create($input);
        $dosen->addMatakuliah($input['matakuliahInput']);

        $this->clearInput();
        $this->emit('stored', ['instance' => $dosen->nama , 'dismiss' => $this->dismissState]);
    }

    public function clearInput() {
        $this->nama = null;
        $this->nip = null;
        $this->inisial = null;
        $this->matakuliahInput = [];
        $this->emit('resetData');
    }
}
