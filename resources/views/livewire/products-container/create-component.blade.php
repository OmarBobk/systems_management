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
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Name"
                                                   type="text" wire:model.lazy="name_create">
                                            @error('name_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
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
                                                   type="text" wire:model.lazy="code_create">
                                            @error('code_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
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
                                                   type="text" wire:model.lazy="serial_create">
                                            @error('serial_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--Cost--}}
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Cost"
                                                   type="number" wire:model.lazy="cost_create">
                                            @error('cost_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

{{--                                --}}{{--Prcie--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <div class="input-group input-group-merge input-group-alternative">--}}
{{--                                            <div class="input-group-prepend">--}}
{{--                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>--}}
{{--                                            </div>--}}
{{--                                            <input class="form-control" placeholder="Price"--}}
{{--                                                   type="number" wire:model.lazy="price_create">--}}
{{--                                            @error('price_create') <span class="text-red-500">{{ $message }}</span> @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                {{--Amount--}}
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Amount"
                                                   type="number" wire:model.lazy="amount_create">
                                            @error('amount_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                {{--Brands--}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect3">Brand</label>
                                        <select class="form-control" id="exampleFormControlSelect3" wire:model.lazy="brand_id_create">
                                            <option >...</option>
                                            @forelse($brands_create as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                        @error('brand_id_create') <span class="text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </div>


                                {{--Categories--}}
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect4">Categories</label>
                                        <select class="form-control" id="exampleFormControlSelect4" wire:model.lazy="category_id_create">
                                            <option >...</option>
                                            @forelse($categories_create as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('category_id_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                {{--Description--}}
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect4">Description</label>
                                        <textarea class="form-control" rows="5"
                                                  wire:model.lazy="description_create"></textarea>
                                        @error('description_create') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="store">Save</button>
                                <button wire:click="testing"
                                        wire:click="emptyCreateForm"
                                        type="button"
                                        class="btn btn-danger my-4">Empty</button>
                            </div>
                        </form>
                    </div>
                </div>

</div>
