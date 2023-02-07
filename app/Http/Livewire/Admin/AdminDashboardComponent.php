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
            'dates' => ["24-12", "25-12", "26-12", "27-12", "28-12", "29-12", "30-12", "31-12", "01-01", "02-01", "03-01",
                "04-01", "05-01", "06-01", "07-01", "08-01", "09-01", "10-01", "11-01", "12-01", "13-01", "14-01", "15-01",
                "16-01", "17-01", "18-01", "19-01", "20-01", "21-01", "22-01", "23-01", "24-01", "25-01", "26-01", "27-01", "28-01",
                "29-01", "30-01", "31-01", "01-02", "02-02", "03-02", "04-02",
                ],
            'values' => [216, 73, 181, 204, 186, 106, 114, 642, 27, 790, 334, 612, 592, 260, 551, 278, 408, 223, 25,
                285, 282, 247, 505, 380, 600, 50, 125, 115, 380, 275, 327, 519, 210, 268, 164, 478,
                420, 198, 219, 230, 280, 313, 1133,
                ],
        ];

        $chart->labels($data['dates']);
//        $chart->dataset('Monthly Report', 'pie', $data['values']);
        $chart->dataset('Days: '. count($data['values']) .' Average: '. number_format(array_sum($data['values']) / count($data['values']), 2), 'line', $data['values']);
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
