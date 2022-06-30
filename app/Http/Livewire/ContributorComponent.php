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
    public int $original_amount;

    public $show_profits_details;

    public function mount(Contributor $contributor)
    {
        $this->show_profits_details = false;
        $this->original_amount = 0;
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

        $this->get_records();

        $all_data          = array_merge($this->costs, $this->profits, $this->expenses);

        $alll_data_v2 = [
            0 => [
                'id' => 1,
                'type' => 'profits',
                'amount' => 26,
                'contribution_id' => 1,
                'created_at' => now(),
            ],
        ];

        $this->rows_data         = $this->get_records_v2();



        /*
            [
                Contribution 1   => [
                                        Income::whereType('profit')->get(),
                                        Income::whereType('cost')->get(),
                                        Expense::all(),
                                    ],
                Contribution 2   => [
                                        Income::whereType('profit')->get(),
                                        Income::whereType('cost')->get(),
                                        Expense::all(),
                                    ],
            ]
         */

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

    public function get_records()
    {
        $profits    = [];
        $costs      = [];
        $expenses   = [];
        $org_amount = 0;

        foreach ($this->contributions as $contribution) {
            $costs[]     = collect($contribution->costs)->toArray();
            $profits[]   = collect($contribution->profits)->toArray();
            $expenses[]  = collect($contribution->expenses)->toArray();
            $org_amount += $contribution->amount + $contribution->expenses()->whereType('shopping')->first()->amount;
        }

        $this->profits         = array_merge(...$profits);
        $this->costs           = array_merge(...$costs);
        $this->expenses        = array_merge(...$expenses);
        $this->original_amount = $org_amount;

    }

    public function get_records_v2()
    {
        $profits  = [];
        $costs    = [];
        $expenses = [];

        foreach ($this->contributions as $contribution) {
            $profit   = $contribution->profits;
            $cost     = $contribution->costs;
            $expense  = $contribution->expenses;

            $profits[] = [
                'type' => 'Profits',
                'amount' => $profit->sum('amount'),
                'status' => 'Income',
                'contribution_id' => $contribution->id,
            ];

            $costs[] = [
                'type' => 'Costs',
                'amount' => $cost->sum('amount'),
                'status' => 'Income',
                'contribution_id' => $contribution->id,
            ];

            $expenses[] = [
                'type'   => 'Expenses',
                'amount' => $expense->sum('amount'),
                'status' => 'Outcome',
                'contribution_id' => $contribution->id,
            ];
        }

        $data = [
            'All' => array_merge(
                collect($profits)->toArray(),
                collect($costs)->toArray(),
                collect($expenses)->toArray()
            ),
            'Costs'    => collect($costs)->toArray(),
            'Profits'  => collect($profits)->toArray(),
            'Expenses' => collect($expenses)->toArray(),
        ];

        return $data;

    }

    public function toggleShowProfitsDetails($p, $cont)
    {
        $this->show_profits_details = !$p;

        dd($cont);
    }

}
