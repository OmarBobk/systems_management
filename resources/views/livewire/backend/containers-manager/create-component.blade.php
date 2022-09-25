<div>
    <div class="card bg-secondary border-0 mb-0" style="box-shadow: 0 0 2rem 0 rgb(136 152 170 / 32%)">
        <div class="card-body px-lg-5 py-lg-5" style="background:#fff;">
            <form role="form">
                <div class="row">
                    {{--Bills--}}
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Bill</label>
                            <select class="form-control" id="exampleFormControlSelect3" wire:model="bill_id">
                                <option>...</option>
                                @forelse($bills as $bill)
                                    <option value="{{$bill->id}}">
                                        {{$bill->serial}} | {{$bill->amount}} | {{$bill->seller->name}}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="button" class="btn btn-primary my-4"
                            wire:click="store">Save
                    </button>
                    <button wire:click="closeCreateForm"
                            type="button"
                            class="btn btn-danger my-4">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
