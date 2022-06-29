<?php

namespace App\Http\Livewire;

use App\Models\Contributor;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ContributorComponent extends Component
{
    public $colors, $breadcrumbs;

    public Contributor $contributor;
    public Collection $contributions;
    public array $profits, $costs, $expenses, $tableTabs;
    public string $selected;
    public $dataTable;
    public $rows_data;
    public $record_url;

    public function mount(Contributor $contributor)
    {
//        $this->users = ;
        $this->tableTabs = [
            0 => "All",
            1 => "Costs",
            2 => "Profits",
            3 => "Expenses"
        ];
        $this->selected      = 'All';
        $this->contributions = $contributor->contributions;
        $contributor_id      = $contributor->id;

        $this->breadcrumbs = [
            [
                'route' => ['contributor', $contributor_id],
                'index' => 'Contributor / ' . $contributor_id,
            ],
        ];

        $this->contributor = $contributor;
        $this->profits     = $this->get_profits();
        $this->costs       = $this->get_costs();
        $this->expenses    = $this->get_expenses();
        $all_data          = array_merge($this->costs, $this->profits, $this->expenses);


        $this->rows_data         = [
            'All'      => $all_data,
            'Costs'    => $this->costs,
            'Profits'  => $this->profits,
            'Expenses' => $this->expenses,
        ];
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

    public function get_expenses()
    {
        $expenses = [];
        foreach ($this->contributions as $contribution) {
            $expenses[] = collect($contribution->expenses)->toArray();
        }
        return array_merge(...$expenses);
    }

    public function record_url($e)
    {
        return $e;
    }
}
