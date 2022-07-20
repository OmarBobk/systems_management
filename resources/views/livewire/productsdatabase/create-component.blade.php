<div>
    <div class="card bg-secondary border-0 mb-0" style="box-shadow: 0 0 2rem 0 rgb(136 152 170 / 32%)">
        <div class="card-body px-lg-5 py-lg-5" style="background:#fff;">
            <form role="form">
                <div class="row">

                    {{--Name--}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="ni ni-email-83"></i>
                                    </span>
                                </div>

                                <input class="form-control" placeholder="Name"
                                       type="text" wire:model="name">
                            </div>
                            @error('name')
                                <span class="text-red-500" style="margin-left:15%">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>


                    {{--Code--}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Code"
                                       type="text" wire:model="code">
                            </div>
                            @error('code')
                                <span class="text-red-500" style="margin-left:15%">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{--Serial--}}
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Serial"
                                       type="text" wire:model="serial">
                            </div>


                            @error('serial')
                                <span class="text-red-500" style="margin-left:15%" style="
                                margin-left
                                :15%
">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{--Brands--}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Brand</label>
                            <select class="form-control" id="exampleFormControlSelect3" wire:model="brand_id">
                                <option>...</option>
                                @forelse($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                @empty
                                @endforelse
                            </select>


                            @error('brand_id')
                                <span class="text-red-500" style="margin-left:15%">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{--Categories--}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect4">Categories</label>
                            <select class="form-control" id="exampleFormControlSelect4" wire:model="category_id">
                                <option>...</option>
                                @forelse($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        @error('category_id')
                            <span class="text-red-500" style="margin-left:15%">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{--Description--}}
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlSelect4">Description</label>
                            <textarea class="form-control"
                                      wire:model.lazy="description"></textarea>
                        </div>
                        @error('description')
                            <span class="text-red-500" style="margin-left:15%">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="text-center">
                    <button type="button" class="btn btn-primary my-4"
                            wire:click="store">Save
                    </button>
                    <button wire:click="closeCreateComponent"
                            type="button"
                            class="btn btn-danger my-4">Back
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
