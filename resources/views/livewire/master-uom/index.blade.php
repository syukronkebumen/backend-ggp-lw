<main class="main-content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0"></h5>
                            </div>
                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalAdd" wire:click="modalAdd">
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Nama</th>
                                    <th class="text-secondary opacity-7 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->name }}</td>
                                        <td class="align-middle text-center">
                                            <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalEdits" wire:click="clickEdit({{$item->id}})">
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
    @if($modalAdd)
    <div class="modal fade" id="modalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input id="name" type="text" placeholder="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="emailHelp">
                        @error('name')
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
    @if($modalEdit)
    <div class="modal fade" id="modalEdits" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input id="name" type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="name">
                        @error('name')
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
    @if($modalDelete)
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
    @endif
</main>