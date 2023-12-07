<?php

namespace App\Http\Livewire\MasterMaterial;

use App\Models\MasterMaterialModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use function Laravel\Prompts\alert;

class Index extends Component
{
    public $material_code;
    public $material_description;
    public $uom;
    public $batch;
    public $plant;
    public $id;
    public $deleteId;
    public $modalAddMasterMaterial = false;
    public $modalEditMasterMaterial = false;
    public $modalDelete = false;

    public function addMasterMaterial(){
        $this->resetValidation();
        $this->modalAddMasterMaterial = true;
    }

    public function store()
    {
        $this->validate([
            'material_code'   => 'required',
            'material_description' => 'required',
            'uom' => 'required',
            'batch' => 'required',
            'plant' => 'required'
        ]);

        $data = MasterMaterialModel::create([
            'material_code'     => $this->material_code,
            'material_description'   => $this->material_description,
            'uom'   => $this->uom,
            'batch'   => $this->batch,
            'plant'   => $this->plant
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-material');
    }

    public function editMasterMaterial(int $id)
    {   
        $this->id = $id;
        $this->modalEditMasterMaterial = true;
        $this->resetValidation();
        $masterMaterial = MasterMaterialModel::find($id);
        if($masterMaterial){
            $this->material_code = $masterMaterial->material_code;
            $this->material_description = $masterMaterial->material_description;
            $this->uom = $masterMaterial->uom;
            $this->batch = $masterMaterial->batch;
            $this->plant = $masterMaterial->plant;
        }else{
            return redirect()->to('/master_material');
        }
    }

    public function closeModal()
    {
        // Tutup modal dan reset propertis
        $this->modalEditMasterMaterial = false;
        $this->modalAddMasterMaterial = false;
        $this->modalDelete = false;
        $this->reset();
    }

    public function updateMasterMaterial(){
        $this->validate([
            'material_code'   => 'required',
            'material_description' => 'required',
            'uom' => 'required',
            'batch' => 'required',
            'plant' => 'required'
        ]);

        MasterMaterialModel::where('id', $this->id)->update([
            'material_code'     => $this->material_code,
            'material_description'   => $this->material_description,
            'uom'   => $this->uom,
            'batch'   => $this->batch,
            'plant'   => $this->plant
        ]);

        // //flash message
        session()->flash('message', 'Data Berhasil Disimpan.');

        // //redirect
        return redirect()->route('master-material');
    }

    public function hapusId($id)
    {
        $this->modalDelete = true;
        $this->deleteId = $id;
    }

    public function closeModalDelete()
    {
        $this->modalDelete = false;
        $this->reset();

    }

    public function delete()
    {
        $delete = MasterMaterialModel::find($this->deleteId);

        if($delete) {
            $delete->delete();
        }

        //flash message
        session()->flash('message', 'Data Berhasil Dihapus.');

        //redirect
        return redirect()->route('master-material');
    }

    public function render()
    {
        $data = MasterMaterialModel::select(
                            'master_material.id',
                            'master_material.material_code',
                            'master_material.material_description',
                            'master_material.uom',
                            'master_material.batch',
                            'master_material.plant',
                            'master_uom.name as name_uom'
                        )
                        ->leftjoin('master_uom','master_uom.id','=','master_material.uom')
                        ->get();
        $dataUom = DB::table('master_uom')->get();
        return view('livewire.master-material.index', ['data' => $data, 'dataUom' => $dataUom]);
    }
}
