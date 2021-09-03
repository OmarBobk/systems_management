<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0" style="box-shadow: 0 0 2rem 0 rgb(136 152 170 / 32%)">
                    <div class="card-body px-lg-5 py-lg-5" style="background:#fff;">
                        <form role="form">

                            {{--Name--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Name"
                                           type="text" wire:model="name">
                                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Serial--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Serial"
                                           type="text" wire:model="serial">
                                    @error('serial') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Prcie--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Price"
                                           type="number" wire:model="price">
                                    @error('price') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Cost--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Cost"
                                           type="number" wire:model="cost">
                                    @error('cost') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Categories</label>
                                <select class="form-control" id="exampleFormControlSelect2" wire:model="category_id">
                                        <option >...</option>
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                <label class="custom-control-label" for=" customCheckLogin">
                                    <span class="text-muted">Remember me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="@if($updateMode) update @else store @endif">Save</button>
                                <button wire:click="closeCreateComponent"
                                        type="button"
                                        class="btn btn-danger my-4">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
