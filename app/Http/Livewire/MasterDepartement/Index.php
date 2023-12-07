<?php

namespace App\Http\Livewire\MasterDepartement;

use App\Models\MasterDepartementModel;
use Livewire\Component;

class Index extends Component
{
    public $departement;
    public $id;
    public $modalAdd = true;
    public $modalEdit = true;

    public function modalAdd(){
        $this->resetValidation();
        $this->modalAdd = true;
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

    public function modalEdit(int $id)
    {   
        dd($id);
        $this->id = $id;
        $this->modalEdit = true;
        $this->resetValidation();
        $data = MasterDepartementModel::find($id);
        // dd($data);
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

    // public function updateMasterMaterial(){
    //     $this->validate([
    //         'material_code'   => 'required',
    //         'material_description' => 'required',
    //         'uom' => 'required',
    //         'batch' => 'required',
    //         'plant' => 'required'
    //     ]);

    //     MasterMaterialModel::where('id', $this->id)->update([
    //         'material_code'     => $this->material_code,
    //         'material_description'   => $this->material_description,
    //         'uom'   => $this->uom,
    //         'batch'   => $this->batch,
    //         'plant'   => $this->plant
    //     ]);

    //     // //flash message
    //     session()->flash('message', 'Data Berhasil Disimpan.');

    //     // //redirect
    //     return redirect()->route('master-material');
    // }

    public function render()
    {
        $data = MasterDepartementModel::get();
        return view('livewire.master-departement.index', ['data' => $data]);
    }
}
