<?php

namespace App\Http\Livewire\Admin;

use App\Charts\MonthlyProfitsChart;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboardComponent extends Component
{
    public function render()
    {

        $breadcrumbs = [
            [
                'route' => 'backend.dashboard',
                'index' => 'Dashboard'
            ],
        ];

        $chart = new MonthlyProfitsChart;
        $data = DB::table('sales')->select(DB::raw('sum(profit) as total'), DB::raw('MONTH(created_at) month'))->groupBy('month')->get();
        $vals = [];
        $dates =[];
        foreach ($data as $obj) {
            $vals[] = number_format($obj->total / 1000 , 3);
            $dates[] = $obj->new_date;
        }


        $data = [
            // New Version
            'dates' => $dates,
            'values' => $vals,
        ];

        $chart->labels($data['dates']);
//        $chart->dataset('Monthly Report', 'pie', $data['values']);
        $chart->dataset('Days: '. count($data['values']) .' Average: '. number_format(array_sum($data['values']) / count($data['values']), 2), 'line', $data['values']);
//        $chart->minimalist(true);
//        $chart->displayLegend(true);

        $chart->title('Chart Title');


        $all_charts = [];
        $months = DB::table('sales')
            ->select(DB::raw('MONTH(created_at) month'))->groupBy('month')->get()->toArray();

        foreach ($months as $month) {
            $ch = new MonthlyProfitsChart;
            $q = DB::table('sales')
                ->select(DB::raw('DAY(created_at) day'),
                    DB::raw('MONTH(created_at) month'),
                    DB::raw('SUM(profit) as total'))
                ->whereMonth('created_at', '=', $month->month)
                ->groupBy('day', 'month'); // Total of sales for every day in this month

            $avg = DB::table('sales')
                ->select(DB::raw('MONTH(created_at) month'), DB::raw('AVG(profit) as avg'))->groupBy('month')->pluck('avg', 'month');

            $ch->labels($q->pluck('day')->toArray());
            $ch->dataset('Month: '. $month->month . ' Average: '. number_format($avg[$month->month]), 'line', $q->pluck('total')->toArray());
            $all_charts[] = [$ch];
        }


        return view('livewire.backend.admin.admin-dashboard-component', [
            'chart'       => $chart,
            'all_charts'      => $all_charts,
        ])
            ->layout('layouts.user', [
                'breadcrumbs' => $breadcrumbs,
                'chart'       => $chart,
                'all_charts'       => $all_charts,
            ]);
    }
}
