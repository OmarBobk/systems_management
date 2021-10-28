<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0" style="box-shadow: 0 0 2rem 0 rgb(136 152 170 / 32%)">
                    <div class="card-body px-lg-5 py-lg-5" style="background:#fff;">
                        <form role="form">

                            {{--Expense Type--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                        <select class="form-control" wire:model="type">
                                            <option >...</option>
                                            <option value="store">store</option>
                                            <option value="shopping">shopping</option>
                                            <option value="loses">loses</option>
                                        </select>
                                    @error('type') <span class="text-red-500">{{ $message }}</span> @enderror
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

                            {{--Expense Amount--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                        <input type="number" class="form-control"
                                               placeholder="Expense Amount..."
                                               wire:model="amount">
                                    @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Contribution id--}}
                            <div class="form-group mb-3">
                                <select class="form-control" id="exampleFormControlSelect4" wire:model="contribution_id">
                                    <option >...</option>
                                    @forelse($contributors as $contributor)
                                        <option value="{{$contributor->id}}">{{$contributor->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('contribution_id') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>

                            {{--Actions--}}
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="storeExpense">Save</button>
                                <button type="button" class="btn btn-danger my-4"
                                        wire:click="closeCreateExpenseComponent">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
