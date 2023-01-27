<?php

namespace App\Http\Livewire\Admin;

use App\Charts\MonthlyProfitsChart;
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

        $data = [
            'dates' => ["24-12", "25-12", "26-12", "27-12", "28-12", "29-12", "30-12", "31-12", "01-01", "02-01", "03-01", "04-01", "05-01", "06-01", "07-01", "08-01", "09-01", "10-01", "11-01", "12-01", "13-01", "14-01", "15-01", "16-01", "17-01", "18-01", "19-01", "20-01", "21-01"],
            'values' => [216, 73, 181, 204, 186, 106, 114, 642, 27, 790, 334, 612, 592, 260, 551, 278, 408, 223, 25, 285, 282, 247, 505, 380, 600, 50, 125, 115, 380,],
        ];

        $chart->labels($data['dates']);
//        $chart->dataset('Monthly Report', 'pie', $data['values']);
        $chart->dataset('Days: '. 29 .' Average: '. number_format(array_sum($data['values']) / count($data['values']), 2), 'bar', $data['values']);
//        $chart->minimalist(true);
//        $chart->displayLegend(true);

        $chart->title('Chart Title');


        return view('livewire.backend.admin.admin-dashboard-component', [
            'chart'       => $chart,
        ])
            ->layout('layouts.user', [
                'breadcrumbs' => $breadcrumbs,
                'chart'       => $chart,
            ]);
    }
}
