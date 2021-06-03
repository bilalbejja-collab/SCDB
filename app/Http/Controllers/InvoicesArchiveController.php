<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class InvoicesArchiveController extends Controller
{
    /**
     * Only authenticated users can access.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Devuelve las facturas archivadas (deleted_at not null)
        $invoices = Invoice::onlyTrashed()->get();

        return view('invoices.archive_invoices', compact('invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        // Desarchivar la factura cambiando la fecha de borrado a NULL
        Invoice::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_invoice');

        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoice = Invoice::withTrashed()->where('id', $request->invoice_id)->first();
        $invoice->forceDelete();
        session()->flash('delete_invoice');

        return redirect('/archive');
    }
}
