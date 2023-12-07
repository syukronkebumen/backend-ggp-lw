<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    <h6>Master Material</h6>
                    </div>
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0"></h5>
                            </div>
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#addMasterMaterial" wire:click="addMasterMaterial">
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 10%">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Material Code</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Material Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">UoM</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batch</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plant</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>

                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->material_code }}</td>
                                        <td class="align-middle text-center text-sm">
                                            {{ \Illuminate\Support\Str::limit($item->material_description, 10) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ $item->name_uom }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->batch }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->plant }}
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#editMasterMaterial" wire:click="editMasterMaterial({{$item->id}})">
                                                Edit
                                            </button>
                                            <button type="button" class="btn bg-gradient-danger btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#deleteModal" wire:click="hapusId({{$item->id}})">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add --}}
    @if($modalAddMasterMaterial)
    <div class="modal fade" id="addMasterMaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Material Code</label>
                        <input id="material_code" type="text" placeholder="Material Code" wire:model="material_code" class="form-control @error('material_code') is-invalid @enderror" aria-describedby="emailHelp">
                        @error('material_code')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Material Description</label>
                        <input type="text" wire:model="material_description" class="form-control @error('material_description') is-invalid @enderror"  placeholder="Material Description">
                        @error('material_description')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">UoM</label>
                        <select class="form-control @error('uom') is-invalid @enderror" wire:model="uom" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            @foreach($dataUom as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('uom')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Use Batch</label>
                        <select class="form-control @error('batch') is-invalid @enderror" wire:model="batch" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            <option value="ya">YA</option>
                            <option value="tidak">TIDAK</option>
                        </select>
                        @error('batch')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Plant</label>
                        <select class="form-control @error('plant') is-invalid @enderror" wire:model="plant" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            <option value="1000">1000</option>
                            <option value="2003">2003</option>
                        </select>
                        @error('plant')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endif
    {{-- end add modal --}}
    
    {{-- Modal edit --}}
    @if($modalEditMasterMaterial)
    <div class="modal fade" id="editMasterMaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit New Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateMasterMaterial">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Material Code</label>
                        <input id="material_code" type="text" wire:model="material_code" class="form-control @error('material_code') is-invalid @enderror" placeholder="Material Code">
                        @error('material_code')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Material Description</label>
                        <input type="text" wire:model="material_description" class="form-control @error('material_description') is-invalid @enderror"  placeholder="Material Description">
                        @error('material_description')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">UoM</label>
                        <select class="form-control @error('uom') is-invalid @enderror" wire:model="uom" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            @foreach($dataUom as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('uom')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Use Batch</label>
                        <select class="form-control @error('batch') is-invalid @enderror" wire:model="batch" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            <option value="ya">YA</option>
                            <option value="tidak">TIDAK</option>
                        </select>
                        @error('batch')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Plant</label>
                        <select class="form-control @error('plant') is-invalid @enderror" wire:model="plant" id="user" data-live-search="true">
                            <option value="" selected>Masukan Pilihan</option>
                            <option value="1000">1000</option>
                            <option value="2003">2003</option>
                        </select>
                        @error('plant')
                        <span class="invalid-feedback">
                                {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endif
    {{-- Modal Edit --}}
    {{-- @if($modalDelete) --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu yakin hapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
</main>