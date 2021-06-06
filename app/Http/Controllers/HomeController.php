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
        // ------------------------Gráfico redondo----------------------
        $count_all = Invoice::count();
        $count_pagadas = Invoice::where('value_status', 1)->count();
        $count_no_pagadas = Invoice::where('value_status', 2)->count();
        $count_pagadas_parc = Invoice::where('value_status', 3)->count();

        $pagadas_value = $count_pagadas == 0 ? 0 : number_format($count_pagadas / $count_all * 100, 2);
        $no_pagadas_value = $count_no_pagadas == 0 ? 0 : number_format($count_no_pagadas / $count_all * 100, 2);
        $pagadas_parc_value = $count_pagadas_parc == 0 ? 0 : number_format($count_pagadas_parc / $count_all * 100, 2);

        // -------------------------Gráfico de barras---------------------

        // Obtener los nombre de los bancos
        $sections = array(Section::select('name')->orderby('id')->pluck('name')->all())[0];
        $paid_vals = $unpaid_vals = $parcial_paid_vals = [];

        // % de las facturas pagadas de todos los bancos
        foreach (Section::all() as $key => $value) {
            // si un determinado banco no tiene facturas meto 0
            $count_all_per_section = Invoice::where('section_id', Section::all()[$key]->id)->count();
            $paid_vals[] = $count_all_per_section == 0
                ? 0
                : number_format(Invoice::where([['value_status', 1], ['section_id', Section::all()[$key]->id]])->count()
                    / $count_all_per_section * 100, 2);
        }

        // % de las facturas no pagadas de todos los bancos
        foreach ($sections as $key => $value) {
            // si un determinado banco no tiene facturas meto 0
            $count_all_per_section = Invoice::where('section_id', Section::all()[$key]->id)->count();
            $unpaid_vals[] = $count_all_per_section == 0
                ? 0
                : number_format(Invoice::where([['value_status', 2], ['section_id', Section::all()[$key]->id]])->count()
                    / $count_all_per_section * 100, 2);
        }

        // % de las facturas pagadas parcialmente de todos los bancos
        foreach ($sections as $key => $value) {
            // si un determinado banco no tiene facturas meto 0
            $count_all_per_section = Invoice::where('section_id', Section::all()[$key]->id)->count();
            $parcial_paid_vals[] = $count_all_per_section == 0
                ? 0
                : number_format(Invoice::where([['value_status', 3], ['section_id', Section::all()[$key]->id]])->count()
                    / $count_all_per_section * 100, 2);
        }

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
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
                    'data' => [$pagadas_value, $no_pagadas_value, $pagadas_parc_value]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs', 'chartjs_2'));
    }
}
