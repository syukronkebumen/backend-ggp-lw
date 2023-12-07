<?php

namespace App\Http\Livewire\MasterDepartement;

use App\Models\MasterDepartementModel;
use Livewire\Component;

class Index extends Component
{
    public $departement;
    public $id;
    public $deleteId;
    public $modalAdd = true;
    public $modalEdit = false;
    public $modalDelete = false;

    public function modalAdd(){
        $this->resetValidation();
        // $this->modalAdd = true;
    }

    public function store()
    {
        $this->validate([
            'departement'   => 'required'
        ]);

        $data = MasterDepartementModel::create([
            'departement'     => $this->departement
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-departement');
    }

    public function clickEdit($id)
    {   
        $this->id = $id;
        $this->modalEdit = true;
        $this->resetValidation();
        $data = MasterDepartementModel::find($id);
        if($data){
            $this->departement = $data->departement;
        }else{
            return redirect()->to('/master_departement');
        }
    }

    public function closeModal()
    {
        // Tutup modal dan reset propertis
        $this->modalAdd = false;
        $this->modalEdit = false;
        // $this->modalDelete = false;
        $this->reset();
    }

    public function update(){
        $this->validate([
            'departement'   => 'required'
        ]);

        MasterDepartementModel::where('id', $this->id)->update([
            'departement'     => $this->departement
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-departement');
    }

    public function hapusId($id)
    {
        $this->modalDelete = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        $delete = MasterDepartementModel::find($this->deleteId);

        if($delete) {
            $delete->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('master-departement');
    }

    public function render()
    {
        $data = MasterDepartementModel::get();
        return view('livewire.master-departement.index', ['data' => $data]);
    }
}
