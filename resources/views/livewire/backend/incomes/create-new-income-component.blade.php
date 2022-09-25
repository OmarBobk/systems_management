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
                                    <label>
                                        <input class="form-control" placeholder="Name"
                                               type="text" wire:model="name">
                                    </label>
                                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Phone--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <label>
                                        <input class="form-control" placeholder="Phone"
                                               type="tel" wire:model="phone">
                                    </label>
                                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Notes--}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <label>
                                        <textarea placeholder="Notes..."
                                                  wire:model="notes"></textarea>
                                    </label>
                                    @error('notes') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{--Actions--}}
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="storeContributor">Save</button>
                                <button type="button" class="btn btn-danger my-4"
                                        wire:click="closeCreateContributorComponent">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
