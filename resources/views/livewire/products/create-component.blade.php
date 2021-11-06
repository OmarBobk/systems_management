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

                            {{--Code--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Code"
                                           type="text" wire:model="code">
                                    @error('code') <span class="text-red-500">{{ $message }}</span> @enderror
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

                            {{--Amount--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Amount"
                                           type="number" wire:model="amount">
                                    @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Bill--}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Bill</label>
                                <select class="form-control" id="exampleFormControlSelect2"
                                        wire:model="bill_id">
                                        <option value="0">...</option>
                                    @forelse($bills as $bill)
                                        <option value="{{$bill->id}}">
                                            {{$bill->serial}}: {{$bill->seller->name}}
                                            <br> {{$bill->amount}} | {{$bill->created_at->format('Y-m-d')}}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('bill_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{--Seller--}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Seller</label>
                                <select class="form-control" id="exampleFormControlSelect2"
                                        wire:model="seller_id">
                                        <option value="0">...</option>
                                    @if(isset($bill_id))
                                        @if($bill_id != null and $bill_id > 0)
                                            <option value="{{$bills->find($bill_id)->seller->id}}">{{$bills->find($bill_id)->seller->name}}</option>
                                        @endif
                                    @endif
                                </select>
                                @error('seller_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{--Brands--}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Brand</label>
                                <select class="form-control" id="exampleFormControlSelect3" wire:model="brand_id">
                                    <option >...</option>
                                    @if(isset($seller_id) and $seller_id != "0")
                                        @forelse($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @empty
                                        @endforelse
                                    @else
                                    @endif
                                </select>

                                @error('brand_id') <span class="text-red-500">{{ $message }}</span> @enderror

                            </div>

                            {{--Contributior--}}
                            <div class="form-group">
                                <label for="Contributor">Contributor</label>
                                <select class="form-control" id="Contributor"
                                        wire:model="contributor_id">
                                        <option >...</option>
                                    @forelse($contributors as $contributor)
                                        <option value="{{$contributor->id}}">{{$contributor->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('contributor_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{--Contributions--}}
                            <div class="form-group">
                                <label for="Contributions">Contribution</label>
                                <select class="form-control" id="Contributions" wire:model="contribution_id">
                                    <option >...</option>
                                    @if(isset($contributor_id) and $contributor_id != "...")
                                        @forelse($contributions as $contribution)
                                            <option value="{{$contribution->id}}">{{$contribution->amount}}</option>
                                        @empty
                                        @endforelse
                                    @else
                                    @endif
                                </select>

                                @error('contributor_id') <span class="text-red-500">{{ $message }}</span> @enderror

                            </div>

                            {{--Categories--}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect4">Categories</label>
                                <select class="form-control" id="exampleFormControlSelect4" wire:model="category_id">
                                        <option >...</option>
                                    @forelse($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{--Description--}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect4">Description</label>
                                <textarea class="form-control"
                                          wire:model.lazy="description"></textarea>
                                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="store">Save</button>
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
