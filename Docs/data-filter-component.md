- We Can use this component like that:
<pre>

    <x-data-filter 
        :datepicker="true"
        :menu_data="$this->menu_data"
    ></x-data-filter>

</pre>


- Variables:
  - datepicker: Boolean (default: false).
  - menu_data: Array (default: []) ex: 
<pre>
    $menu_data = [
        menu_1_variable => [option_1, option_2],
    ];
</pre>


- php side
  - make $menu_data variable.
  - if you want datepicker make $datepicker true.
  - make new variable $menu_1_variable set its default;