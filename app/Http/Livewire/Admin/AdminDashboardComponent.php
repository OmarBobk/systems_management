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

        $data = DB::table('sales')
            ->select(
                DB::raw('sum(profit) as total'),
                DB::raw('date_format(created_at, "%m-%d") new_date')
            )
            ->groupBy('new_date')->get();


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
            // Old version
//            'dates' => ["24-12", "25-12", "26-12", "27-12", "28-12", "29-12", "30-12", "31-12", "01-01", "02-01", "03-01",
//                "04-01", "05-01", "06-01", "07-01", "08-01", "09-01", "10-01", "11-01",
//                "12-01", "13-01", "14-01", "15-01", "16-01", "17-01", "18-01", "19-01", "20-01", "21-01", "22-01", "23-01", "24-01", "25-01", "26-01", "27-01", "28-01",
//                "29-01", "30-01", "31-01", "01-02", "02-02", "03-02", "04-02",
//                "05-02", "06-02", "07-02", "08-02", "09-02", "10-02", "11-02",
//                "12-02", "13-02", "14-02", "15-02", "16-02", "17-02", "18-02",
//                "19-02", "20-02", "21-02", "22-02", "23-02", "24-02", "25-02",
//                "26-02", "27-02", "28-02", "01-03", "02-03", "03-03", "04-03",
//                "05-03", "06-03", "07-03", "08-03", "09-03", "10-03", "11-03",
//                "12-03", "13-03", "14-03", "15-03", "16-03", "17-03", "18-03",
//                ],
//            'values' => [216, 73, 181, 204, 186, 106, 114, 642, 27, 790, 334, 612, 592, 260, 551, 278, 408, 223, 25,
//                285, 282, 247, 505, 380, 600, 50, 125, 115, 380, 275, 327, 519, 210, 268, 164, 478,
//                420, 198, 219, 230, 280, 313, 1133,
//                440, 453, 489, 160, 227, 123, 327,
//                88, 224, 268, 373, 40, 175, 919,
//                365, 388, 297, 586, 386, 450, 652,
//                280, 633, 222, 295, 263, 324, 794,
//                187, 91, 646, 535, 519, 221, 720,
//                485, 494, 572, 312, 704, 255, 1094
//                ],
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
