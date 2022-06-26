<?php

namespace App\Http\Livewire;

use App\Models\Contribution;
use App\Models\Contributor;
use App\Models\User;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ContributorComponent extends Component
{
    public $colors, $breadcrumbs;

    public Contributor $contributor;
    public Collection $contributions;
    public array $profits, $costs;
    public array $tableData;

    public function mount(Contributor $contributor)
    {
//        $this->users = ;

        $this->tableData = [];
        $this->contributions = $contributor->contributions;;
        $contributor_id = $contributor->id;
        $this->breadcrumbs = [
            [
                'route' => ['contributor', $contributor_id],
                'index' => 'Contributor / ' . $contributor_id,
            ],
        ];
        $this->contributor = $contributor;
        $this->profits = $this->get_profits();
        $this->costs = $this->get_costs();
        $this->incomes = array_merge($this->costs, $this->profits);
    }


    public function render()
    {
//        $records = dd(
//            $this->contributor
//            ->query()
//            ->with('contributions', 'contributions.profits', 'contributions.costs', 'contributions.expenses')
//            ->find($this->contributor->id)
//            );
//            ->paginate(1000)
//            ->withQueryString()
//            ->through(fn($contributor) => [
//                'id' => $contributor->id,
//                'name' => $contributor->name,
////                'created_at' => $contributor->created_at->toFormattedDateString(),
//            ]));

        return view('livewire.contributor.index')
            ->layout('layouts.user', ['breadcrumbs' => $this->breadcrumbs,]);
    }

    public function get_costs()
    {
        $costs = [];
        foreach ($this->contributions as $contribution) {
            $costs[] = collect($contribution->costs)->toArray();
        }
        return array_merge(...$costs);
    }

    public function get_profits()
    {
        $profits = [];
        foreach ($this->contributions as $contribution) {
            $profits[] = collect($contribution->profits)->toArray();
        }
        return array_merge(...$profits);
    }
}
