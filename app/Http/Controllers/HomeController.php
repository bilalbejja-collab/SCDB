<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

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
        //=================Tasa estadística de implementación de casos======================
        $count_all = Invoice::count();
        $count_invoices1 = Invoice::where('value_status', 1)->count();
        $count_invoices2 = Invoice::where('value_status', 2)->count();
        $count_invoices3 = Invoice::where('value_status', 3)->count();

        if ($count_invoices2 == 0) {
            $nspainvoices2 = 0;
        } else {
            $nspainvoices2 = number_format($count_invoices2 / $count_all * 100, 2);
        }

        if ($count_invoices1 == 0) {
            $nspainvoices1 = 0;
        } else {
            $nspainvoices1 = number_format($count_invoices1 / $count_all * 100, 2);
        }

        if ($count_invoices3 == 0) {
            $nspainvoices3 = 0;
        } else {
            $nspainvoices3 = number_format($count_invoices3 / $count_all * 100, 2);
        }

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['F. no pagadas', 'F. pagadas', 'F. pagadas parcialmente'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3]
                ]
            ])
            ->options([]);

        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('doughnut')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['Facturas no pagadas', 'Facturas pagadas', 'Facturas pagadas parcialmente'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3]
                ]
            ])
            ->options([]);

        return view('home', compact('chartjs', 'chartjs_2'));
    }
}
