<div>
    <div class="container mt-4 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-7">
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
                                           type="text" wire:model.defer="name">
                                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>


                            <div class="card m-b-30">
                                <div class="card-header border-none pb-0">
                                    <h5 class="card-title ">Choose Category Parent</h5>
                                </div>
                                <div class="card-body !pt-0">
                                    <style>
                                        /* Remove default bullets */
                                        ul, #bobk-myUL {
                                            list-style-type: none;
                                        }

                                        /* Remove margins and padding from the parent ul */
                                        #bobk-myUL {
                                            margin: 0 !important;
                                            padding: 0 !important;
                                        }

                                        /* Style the caret/arrow */
                                        .bobk-caret {
                                            cursor: pointer;
                                            user-select: none; /* Prevent text selection */
                                        }

                                        /* Create the bobk-caret/arrow with a unicode, and style it */
                                        /*.bobk-caret::before {*/
                                        /*    content: "\25B6";*/
                                        /*    color: black;*/
                                        /*    display: inline-block !important;*/
                                        /*    margin-right: 6px !important;*/
                                        /*}*/

                                        /* Rotate the bobk-caret/arrow icon when clicked on (using JavaScript) */
                                        .bobk-caret-down::before {
                                            transform: rotate(90deg);
                                        }

                                        /* Hide the nested list */
                                        .bobk-nested {
                                            display: none;
                                            padding-left: 40px !important;
                                        }

                                        /* Show the bobk-nested list when the user clicks on the bobk-caret/arrow (with JavaScript) */
                                        .bobk-active {
                                            display: block;
                                        }
                                    </style>
                                    <script>
                                        var toggler = document.getElementsByClassName("bobk-caret");
                                        var i;

                                        for (i = 0; i < toggler.length; i++) {
                                            toggler[i].addEventListener("click", function() {
                                                this.parentElement.querySelector(".bobk-nested")
                                                    .classList.toggle("bobk-active");
                                                // this.classList.toggle("fa fa-angle-down");
                                                if(this.firstElementChild.classList.contains('fa-angle-right')) {
                                                    this.firstElementChild.classList.remove('fa-angle-right')
                                                    this.firstElementChild.classList.add('fa-angle-down')
                                                } else {
                                                    this.firstElementChild.classList.remove('fa-angle-down')
                                                    this.firstElementChild.classList.add('fa-angle-right')
                                                }
                                            });
                                        }
                                    </script>
                                    <ul id="bobk-myUL">
                                        <li>
                                            <span class="bobk-caret"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>Categories</span>

                                            <ul class="bobk-nested">
                                                <li>
                                                    No Parent
                                                    <div class="form-check-inline radio-primary mr-[3px]">
                                                        <input type="radio" wire:model.defer="selected_parent_category.null"
                                                               id="customRadioInline5" name="customRadioInline2">
                                                        <label for="customRadioInline5"></label>
                                                    </div>
                                                </li>
                                                @foreach($parent_categories as $category)

                                                    {{-- Parent With no Children--}}
                                                    @if($category->childrenCategories->isEmpty())
                                                        <li>
                                                            {{$category->name}}
                                                            <div class="form-check-inline radio-primary mr-[3px]">
                                                                <input type="radio" wire:model.defer="selected_parent_category.{{$category->id}}"
                                                                       id="customRadioInline5"
                                                                       name="customRadioInline2">
                                                                <label for="customRadioInline5"></label>
                                                            </div>
                                                        </li>
                                                    @endif

                                                    {{--Parent With Children--}}
                                                    @if($category->childrenCategories->isNotEmpty())
                                                        <li>
                                                            <span class="bobk-caret"><i class="fa fa-angle-right pr-[4px] text-[1.5rem]"></i>{{$category->name}}</span>
                                                            <div class="form-check-inline radio-primary mr-[3px]">
                                                                <input type="radio" wire:model.defer="selected_parent_category.{{$category->id}}"
                                                                       id="customRadioInline5" name="customRadioInline2">
                                                                <label for="customRadioInline5"></label>
                                                            </div>
                                                            <ul class="bobk-nested">
                                                                @foreach ($category->childrenCategories as $childCategory)
                                                                    @include('livewire.backend.category.child-category', ['child_category' => $childCategory, 'spaces' => '  '])
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4"
                                        wire:click="@if($updateMode) updateRec @else store @endif">Save</button>
                                <button wire:click="closeModal"
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
