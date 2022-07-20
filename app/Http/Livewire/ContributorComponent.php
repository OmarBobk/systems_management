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

    public $show_details, $show_details_type, $show_details_contribution_id;

    public function mount(Contributor $contributor)
    {
        $this->show_details_type = '';
        $this->show_details      = [];
        $this->original_amount   = 0;
        $this->selected          = 'All';
        $this->contributions     = $contributor->contributions;
        $contributor_id          = $contributor->id;
        $this->contributor       = $contributor;
        $this->rows_data         = $this->get_records_v2();

        $this->tableTabs = [
            0 => "All",
            1 => "Costs",
            2 => "Profits",
            3 => "Expenses"
        ];

        $this->breadcrumbs = [
            [
                'route' => ['contributor', $contributor_id],
                'index' => 'Contributor / ' . $contributor_id,
            ],
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

    /**
     *
     * @return array
     */
    public function get_records_v2(): array
    {
        $profits    = [];
        $costs      = [];
        $expenses   = [];
        $org_amount = 0;

        foreach ($this->contributions as $contribution) {
            $shopping_expenses = $contribution->expenses()->whereType('shopping')->first()->amount ?? 0;
            $profit      = $contribution->profits;
            $cost        = $contribution->costs;
            $expense     = $contribution->expenses;
            $org_amount += $contribution->amount + $shopping_expenses;

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

        $this->original_amount = $org_amount;

        return [
            'All' => array_merge(
                collect($profits)->toArray(),
                collect($costs)->toArray(),
                collect($expenses)->toArray()
            ),
            'Costs'    => collect($costs)->toArray(),
            'Profits'  => collect($profits)->toArray(),
            'Expenses' => collect($expenses)->toArray(),
        ];

    }

    public function toggleShowProfitsDetails($type, $contribution_id)
    {
        $type_cont_id = strtolower($type).'.'.$contribution_id;
        $this->show_details_type = $type;
        $this->show_details_contribution_id = $contribution_id;

        if(!empty($this->show_details)) {
            if(array_key_first($this->show_details) === $type_cont_id) {
                $this->show_details = [];
            } else {
                $this->show_details = [
                    $type_cont_id => true
                ];
            }
        } else {
            $this->show_details = [
                $type_cont_id => true
            ];
        }
    }

    public function get_records_details($contribution_id, $type) {
        $type = strtolower($type);

        if ($type == 'profits') {
            return $this->contributor->contributions()->find($contribution_id)->profits;
        } elseif($type == 'expenses') {
            return $this->contributor->contributions()->find($contribution_id)->expenses;
        } else {
            return $this->contributor->contributions()->find($contribution_id)->costs;
        }
    }



    public function updatedSelected()
    {
        $this->show_details = [];
    }

}
