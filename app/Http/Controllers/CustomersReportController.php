<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Section;
use Illuminate\Http\Request;

class CustomersReportController extends Controller
{
    /**
     * index customers report
     */
    public function index()
    {
        $sections = Section::all();
        return view('reports.customers_report', compact('sections'));
    }

    /**
     * Busca facturas por cliente(bancos)
     */
    public function searchCustomers(Request $request)
    {
        // Buscar sin fecha
        if ($request->section && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = Invoice::select('*')->where('section_id', '=', $request->section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('reports.customers_report', compact('sections'))->withDetails($invoices);
        }
        // Buscar por fecha
        else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = Invoice::whereBetween('date', [$start_at, $end_at])->where('section_id', '=', $request->section)->where('product', '=', $request->product)->get();
            $sections = Section::all();
            return view('reports.customers_report', compact('sections'))->withDetails($invoices);
        }
    }
}
