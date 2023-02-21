<?php

namespace App\Http\Livewire\Backend;

use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use function session;
use function view;

class SaleComponent extends Component
{

    use WithPagination;

    public bool $isCreateComponentOpen = false;
    public bool $updateMode            = false;
    public $price, $cost, $profit, $total, $amount, $sale_id;

    public $all_profits, $all_amounts, $all_costs;

    public $start_from = '';
    public $end_at = '';

    public $menu_data =[];
    public $pagination = 5;
    public $selling_type = 'All';
    public $order_by = 'Date';

    protected $queryString = [
        'start_from' => ['except' => ''],
        'end_at'     => ['except' => '']
    ];

    protected array $rules = [
        'price'  => 'required',
        'cost'   => 'required',
        'profit' => 'required',
        'total'  => 'required',
        'amount' => 'required',
    ];

    public function mount()
    {


    }

    public function render()
    {

        $this->menu_data = [
            'pagination'   => ['All', 5, 10, 15],
            'selling_type' => ['All', 'Kontor', 'Invoice', 'Products'],
            'order_by' => ['Date', 'ID', 'Profit', 'Price'],
        ];

        $ordering = [
            'Date' => 'updated_at',
            'Price' => 'net_price',
            'ID' => 'id',
            'Profit' => 'profit',
        ];


        $this->all_profits = 0;
        $this->all_amounts = 0;
        $this->all_costs = 0;
        $sales = Sale::with('product')
            ->whereBetween('updated_at', [
                $this->start_from ==''?'1900-01-01':date('Y-m-d H:i:s', strtotime($this->start_from)),
                $this->end_at == '' ? '2322-02-11':date('Y-m-d H:i:s', strtotime($this->end_at))
            ])
            ->orderBy(
                $ordering[$this->order_by],
                'DESC'
            );

        foreach($sales as $sale) {
            $this->all_profits += $sale->profit;
            $this->all_amounts += $sale->amount;
            $this->all_costs   += $sale->cost * $sale->amount;
        }

        return view('livewire.backend.sales.index-component', [
            'sales' => $sales->paginate($this->pagination),
        ])->layout('layouts.user', [
            'breadcrumbs' => [
                [
                    'route' => 'backend.sales',
                    'index' => 'Sales'
                ],
            ]
        ]);
    }

    public function edit(Sale $sale)
    {
        $this->sale_id        = $sale->id;
        $this->price          = $sale->net_price;
        $this->cost           = $sale->cost;
        $this->profit         = $sale->profit;
        $this->total          = $sale->total;
        $this->amount         = $sale->amount;
        $this->updateMode     = true;
        $this->openCreateComponent();
    }

    public function update()
    {

        $this->validate();

        Sale::find($this->sale_id)->update([
            'net_price'    => $this->price,
            'cost'         => $this->cost,
            'profit'       => $this->profit,
            'total'        => $this->total,
            'amount'       => $this->amount,
            'user_id'      => Auth::user()->id,
        ]);

        session()->flash('message', 'Sale Updated');
        session()->flash('alert' , 'success');

        $this->closeCreateComponent();
        $this->resetCreateComponent();
    }

    public function delete(int $id)
    {
        Sale::find($id)->delete();
        session()->flash('message', 'Sale deleted.');
        session()->flash('alert', 'success');
    }

    public function openCreateComponent()
    {
        $this->isCreateComponentOpen = true;
    }

    public function closeCreateComponent()
    {
        $this->isCreateComponentOpen = false;
    }

    public function resetCreateComponent()
    {
        $this->reset('total', 'price', 'cost', 'profit', 'updateMode', 'sale_id', 'amount');
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
