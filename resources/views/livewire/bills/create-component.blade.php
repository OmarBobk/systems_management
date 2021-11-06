<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0" style="box-shadow: 0 0 2rem 0 rgb(136 152 170 / 32%)">
                    <div class="card-body px-lg-5 py-lg-5" style="background:#fff;">
                        <form role="form">

                            {{--Type--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <select class="form-control" wire:model="type">
                                        <option value="0">...</option>
                                        <option value="goods">Other</option>
                                        <option value="goods">Goods</option>
                                    </select>
                                    @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
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

                            {{--Description--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <textarea class="form-control" placeholder="Description"
                                              wire:model="description"></textarea>
                                    @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Quantity--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Items Quantity"
                                           type="number" wire:model="quantity">
                                    @error('quantity') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Serial--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Serial"
                                           type="number" wire:model="serial">
                                    @error('serial') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Seller--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <select class="form-control" wire:model.lazy="seller_id">
                                        <option >...</option>
                                        @forelse($sellers as $seller)
                                            <option value="{{$seller->id}}">{{$seller->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('seller_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Contribution--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <select class="form-control" wire:model.lazy="contribution_id">
                                        <option >...</option>
                                        @forelse($contributions as $contribution)
                                            <option value="{{$contribution->id}}">
                                                {{$contribution->contributor->name}}: {{$contribution->amount}}
                                                <br> {{$contribution->updated_at->format('Y-m-d')}}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('contribution_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
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
