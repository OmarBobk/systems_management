<div>
    <div class="row" style="height: 2000px;">

        <div class="col-6">
            <div class="bobk" x-data="{ message: 'I ❤️ Alpine' }">
                <h1 x-show="true" x-text="message"></h1>
            </div>

            <div>
                <h1>Counter With Alpine JS</h1>
                <div x-data="{count: 0}">
                    <button @click="count++">Increment</button>

                    <h1 x-text="count"></h1>
                </div>
            </div>

            <div x-data="{ omar: false }">
                <button @click="omar = true">Expand</button>
                <button @click="omar = false">Hide</button>

                <span x-show="omar">
                  Content...
                </span>
            </div>
            <div x-data="learndispatch">
                <button @foo="handlefooevent" @click="$dispatch('foo')">Dispatch</button>
                {{--                <button @foo="handlefooevent" @click="handleclickfromlearndispatch">Dispatch</button>--}}
                <div></div>

            </div>

            <div x-data="listOfData('List Of Data Parameter Msg')">
                <button @click="toggleContent">Toggle Content</button>
                <h1 x-show="content">Content....</h1>
                <br>

                <button @click="fuckme()">click</button>
                <br>

                <button @click="dropAlert">Drop Alert</button>
                <span x-init="$watch('alert', (value, oldValue) => console.log(value, oldValue))"></span>
                <br>

                <button @click="handleclickbobk" message="Hello World">Say Hi</button>

                <h1 x-show="alert" x-text="alertMsg"></h1>
            </div>

            <div x-data>
                <h1>Testing Global Scopes</h1>
                <br>
                <span x-text="$store.testingglobalscopes.current"></span>
                <br>
            </div>


            <div x-data>
                <template x-for="test in $store.testingglobalscopes.items">
                    <li x-text="test"></li>
                </template>
            </div>


            <div x-data="{colors: []}">
                <input type="checkbox" wire:model="colors.1" x-model="colors" value="red">
                <input type="checkbox" wire:model="colors.2" x-model="colors" value="black">
                <input type="checkbox" wire:model="colors.3" x-model="colors" value="blue">
                Colors: <span x-text="colors"></span>

                <br>
                Colors:
                <span>
                    @if(isset($colors[1]))
                        {{$colors[1]}}
                    @endif
                    @if(isset($colors[2]))
                        {{$colors[2]}}
                    @endif
                    @if(isset($colors[3]))
                        {{$colors[3]}}
                    @endif
                </span>

            </div>


            <div x-data="{
                        foo: 'bar',
                        testingRefInConsole() {
                            console.log(this.$refs)
                        }
                    }">
                <button @click="alert($refs[foo+'-item'].innerText)">Test 1</button>
                <button @click="alert($refs[foo+'-item'].innerText)">Test 2</button>
                <button @click="console.log($refs)">Test 3</button>
                <button @click="testingRefInConsole">Test 4</button>

                <p ::x-ref=" foo">
                    lorem ipsum
                </p>
            </div>
            <script>
                document.addEventListener('alpine:init', () => {

                    Alpine.data('testingRefs', () => ({
                        foo: 'bar',
                        testingRefInConsole() {
                            console.log(this.$refs)
                        }
                    }))

                    // Regster new component
                    Alpine.store('testingglobalscopes', {
                        current: 'first',
                        items: ['one', 'tow', 'three']
                    });


                    // Important!!!!!!!
                    console.log(Alpine.store('testingglobalscopes').current)

                    Alpine.data('learndispatch', () => ({
                        handleclickfromlearndispatch(e) {
                            e.target.dispatchEvent(new CustomEvent('foo', {bubbles: true}))
                        },
                        handlefooevent() {
                            console.log('hi fuafdskf;jasd')
                            alert("Button Was Clicked1")
                        },
                        omar: "fuck socyite"
                    }))

                    Alpine.data('listOfData', (msg = 'default') => ({
                        handleclickbobk(e) {
                            console.log(e.view.Alpine);
                            alert(e.target.getAttribute('message'))
                        },
                        count: 0,
                        init() {
                            // This code will be executed before Alpine
                            // initializes the rest of the component.
                            console.log('hi omar')
                        },
                        fuckme() {
                            // This code will be executed when you call it.
                            console.log('hi fuckme')
                        },
                        content: false,
                        toggleContent() {
                            this.content = !this.content
                        },
                        alert: false,
                        alertMsg: msg,
                        dropAlert() {
                            this.alert = !this.alert
                        },
                    }))

                    // document.addEventListener('livewire:load', () => {
                    //     Livewire.emit('alpinetestingevent')
                    // })

                })
            </script>

        </div>

    </div>

</div>
