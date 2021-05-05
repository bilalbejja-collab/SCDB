<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoicesAttachments;
use App\InvoicesDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetailsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoicesDetails  $invoicesDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $details  = InvoicesDetails::where('invoice_id', $id)->get();
        $attachments  = InvoicesAttachments::where('invoice_id', $id)->get();

        return view('invoices.details_invoice', compact('invoice', 'details', 'attachments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // borrar en bd
        $invoices = InvoicesAttachments::findOrFail($request->id_file);
        $invoices->delete();
        // borrar en el disco
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);

        session()->flash('delete', 'El archivo adjunto se ha eliminado correctamente');
        return back();
    }

    /**
     * Descargar el archivo adjunto
     */
    public function get_file($invoice_number, $file_name)
    {
        $ruta = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($ruta);
    }

    /**
     * Abre el adjunto adjunto
     */
    public function open_file($invoice_number, $file_name)
    {
        $ruta = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($ruta);
    }
}
