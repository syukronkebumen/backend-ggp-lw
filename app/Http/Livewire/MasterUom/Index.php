<?php

namespace App\Http\Livewire\MasterUom;

use App\Models\MasterUomModel;
use Livewire\Component;

class Index extends Component
{
    public $name;
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
            'name'   => 'required'
        ]);

        $data = MasterUomModel::create([
            'name'     => $this->name
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-uom');
    }

    public function clickEdit($id)
    {   
        $this->id = $id;
        $this->modalEdit = true;
        $this->resetValidation();
        $data = MasterUomModel::find($id);
        if($data){
            $this->name = $data->name;
        }else{
            return redirect()->to('/master_uom');
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
            'name'   => 'required'
        ]);

        MasterUomModel::where('id', $this->id)->update([
            'name'     => $this->name
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-uom');
    }

    public function hapusId($id)
    {
        $this->modalDelete = true;
        $this->deleteId = $id;
    }

    public function delete()
    {
        $delete = MasterUomModel::find($this->deleteId);

        if($delete) {
            $delete->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('master-uom');
    }

    public function render()
    {
        $data = MasterUomModel::get();
        return view('livewire.master-uom.index', ['data'=> $data]);
    }
}
