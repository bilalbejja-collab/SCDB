<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Only authenticated users can access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_all = Invoice::count();
        $count_pagadas = Invoice::where('value_status', 1)->count();
        $count_no_pagadas = Invoice::where('value_status', 2)->count();
        $count_pagadas_parc = Invoice::where('value_status', 3)->count();

        // Obtener los nombre de los bancos
        $sections = array(Section::select('name')->orderby('id')->pluck('name')->all())[0];

        // % de las facturas pagadas
        foreach ($sections as $key => $value) {
            $key++;
            $paid_vals[] = number_format(Invoice::where([['value_status', 1], ['section_id', $key]])->count()
                / Invoice::where('section_id', $key > 0 ? 1 : 0)->count() * 100, 2);
        }

        // % de las facturas no pagadas
        foreach ($sections as $key => $value) {
            $key++;
            $unpaid_vals[] = number_format(Invoice::where([['value_status', 2], ['section_id', $key]])->count()
                / Invoice::where('section_id', $key > 0 ? 2 : 0)->count() * 100, 2);
        }


        // % de las facturas pagadas parcialmente
        foreach ($sections as $key => $value) {
            $key++;
            $parcial_paid_vals[] = number_format(Invoice::where([['value_status', 3], ['section_id', $key]])->count()
                / Invoice::where('section_id', $key > 0 ? 1 : 0)->count() * 100, 2);
        }

        $nspainvoices1 = $count_no_pagadas == 0 ? 0 : number_format($count_pagadas / $count_all * 100, 2);
        $nspainvoices2 = $count_no_pagadas == 0 ? 0 : number_format($count_no_pagadas / $count_all * 100, 2);
        $nspainvoices3 = $count_no_pagadas == 0 ? 0 : number_format($count_pagadas_parc / $count_all * 100, 2);

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            /*
            ->labels(['Pagadas', 'No pagadas', 'Pagadas parcialmente'])
            ->datasets([
                [
                    'backgroundColor' => ['#81b214', '#ec5858',  '#ff9642'],
                    'data' => [$nspainvoices1, $nspainvoices2, $nspainvoices3]
                ]
            ])
            ->options([]);
*/
            ->labels($sections)
            ->datasets([
                [
                    "label" => "Pagadas",
                    'backgroundColor' => '#81b214',
                    'data' => $paid_vals
                ],
                [
                    "label" => "No pagadas",
                    'backgroundColor' => '#ec5858',
                    'data' => $unpaid_vals
                ],
                [
                    "label" => "Pagadas parcialmente",
                    'backgroundColor' => '#ff9642',
                    'data' => $parcial_paid_vals
                ]
            ])
            ->options([]);



        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['Facturas pagadas', 'Facturas no pagadas',  'Facturas pagadas parcialmente'])
            ->datasets([
                [
                    'backgroundColor' => ['#81b214', '#ec5858', '#ff9642'],
                    'data' => [$nspainvoices1, $nspainvoices2, $nspainvoices3]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs', 'chartjs_2'));
    }
}
