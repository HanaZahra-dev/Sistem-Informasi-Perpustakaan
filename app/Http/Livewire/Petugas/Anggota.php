<?php

namespace App\Http\Livewire\Petugas;

use App\Models\Anggota as ModelsAnggota;
use Livewire\Component;
use Livewire\WithPagination;

class Anggota extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $siswa, $guru, $search;

    public function siswa()
    {
        $this->format();
        $this->siswa = true;
    }

    public function guru()
    {
        $this->format();
        $this->guru = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsAnggota::query();

        if ($this->siswa) {
            $query->where('jenis_anggota', 'siswa');
        } elseif ($this->guru) {
            $query->where('jenis_anggota', 'guru');
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('nis_nip', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_anggota', 'like', '%' . $this->search . '%');
            });
        }

        $anggota = $query->latest()->paginate(10);

        return view('livewire.petugas.anggota', compact('anggota'));
    }

    public function format()
    {
        $this->siswa = false;
        $this->guru  = false;
        $this->resetPage();
    }
}