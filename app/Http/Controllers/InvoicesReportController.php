<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        return view('reports.invoices_report');
    }

    /**
     * Busca facturas
     */
    public function searchInvoices(Request $request)
    {
        $rdio = $request->rdio;

        // Buscar por tipo de factura
        if ($rdio == 1) {

            // En caso de no especificar una fecha
            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::select('*')->where('status', '=', $request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report', compact('type'))->withDetails($invoices);
            }
            // En caso de especificar una fecha
            else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoice::whereBetween('date', [$start_at, $end_at])->where('status', '=', $request->type)->get();
                return view('reports.invoices_report', compact('type', 'start_at', 'end_at'))->withDetails($invoices);
            }
        }
        // Buscar por el número de factura
        else {
            $invoices = Invoice::select('*')->where('number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report')->withDetails($invoices);
        }
    }
}
