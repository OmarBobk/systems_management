<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class ContributorComponent extends Component
{
    public $colors;

    public Contributor $contributor;

    public function mount(Contributor $contributor)
    {
        $this->contributor = $contributor;
    }


    public function render()
    {
        return view('livewire.contributor.index')->layout('layouts.user');
    }
}
