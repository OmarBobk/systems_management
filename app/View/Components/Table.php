<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public array  $rows = [],
        public array  $columns = [],
        public array  $tabs = [],
        public string $selected = '',
        public bool   $striped = false,
        public string $tableTextLinkLabel = 'Link',
        public string $customFieldName    = '',
        public string $actionText = 'Action')
    {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }

}
