<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Invoice;
use App\InvoicesAttachments;
use App\InvoicesDetails;
use App\Notifications\AddInvoice;
use App\Notifications\NewInvoice;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
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
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|unique:invoices|max:255',
        ], [
            'number.unique' => 'Ya existe una factura con el número introducido',
        ]);

        Invoice::create([
            'number' => $request->number,
            'date' => $request->date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_IVA,
            'rate_vat' => $request->IVA,
            'total' => $request->total,
            'status' => 'no pagada',
            // 2 -> no pagadas
            'value_status' => 2,
            'note' => $request->note,
        ]);

        $invoice = Invoice::latest()->first();

        InvoicesDetails::create([
            'invoice_id' => $invoice->id,
            'invoice_number' => $request->number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'no pagada',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->number;

            $attachment = new InvoicesAttachments();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $invoice_number;
            $attachment->created_by = Auth::user()->name;
            $attachment->invoice_id = $invoice->id;
            $attachment->save();

            // mover la imagen
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        $user = User::first();

        Notification::send($user, new NewInvoice($invoice));

        session()->flash('Add', 'Se agregó la factura con éxito');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.status_invoice', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit_invoice', compact('sections', 'invoice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;

        $this->validate($request, [
            'number' => 'required|max:255|unique:invoices,number,' . $id,
        ], [
            'number.unique' => 'Ya existe una factura con el número introducido',
        ]);

        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->update([
            'number' => $request->number,
            'date' => $request->date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->amount_commission,
            'discount' => $request->discount,
            'value_vat' => $request->value_IVA,
            'rate_vat' => $request->IVA,
            'total' => $request->total,
            'note' => $request->note,
        ]);

        session()->flash('Edit', 'La factura se actualizó con éxito');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = Invoice::where('id', $id)->first();
        $details = InvoicesAttachments::where('invoice_id', $id)->first();

        $code = $request->code;
        if (!$code == 2) {
            // FORCE DELETE
            // Borra la carpeta con todos los  a.adjuntos
            if (!empty($details->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
            }
            $invoice->forceDelete();
            session()->flash('delete_invoice');

            return redirect('/invoices');
        } else {
            // SOFT DELETE
            $invoice->delete();
            session()->flash('archive_invoice');

            return redirect('/archive');
        }
    }

    /**
     * Devuelve los productos de una sección
     */
    public function getProducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("name", "id");
        return json_encode($products);
    }

    /**
     * Actualizar estado de pago de facturas
     */
    public function statusUpdate($id, Request $request)
    {
        $invoice = Invoice::findOrFail($id);

        if ($request->status === 'pagada') {
            $invoice->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date,
            ]);

            // Añadir nuevo detalle - pagada
            InvoicesDetails::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 1,
                'payment_date' => $request->payment_date,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $request->validate([
                'ammount_paid' => 'required|min:0|max:' . $invoice->total,
            ], [
                'ammount_paid.min' => 'La cantidad pagada debe ser mayor que cero.',
                'ammount_paid.max' => 'La cantidad pagada debe ser menor que el total.',
            ]);

            $invoice->update([
                'value_status' => 3,
                'status' => $request->status,
                // actualizo el total
                'total' => $invoice->total - $request->ammount_paid,
                'payment_date' => $request->payment_date,
            ]);

            // Añadir nuevo detalle - pagada parcialmente
            InvoicesDetails::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 3,
                'payment_date' => $request->payment_date,
                'ammount_paid' => $request->ammount_paid,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        }

        session()->flash('status_update');
        return redirect('/invoices');
    }

    /**
     * Devuelve las facturas pagadas
     */
    public function paidInvoices()
    {
        $invoices = Invoice::where('value_status', 1)->get();
        return view('invoices.paid_invoices', compact('invoices'));
    }

    /**
     * Devuelve las facturas no pagadas
     */
    public function unpaidInvoices()
    {
        $invoices = Invoice::where('value_status', 2)->get();
        return view('invoices.unpaid_invoices', compact('invoices'));
    }

    /**
     * Devuelve las facturas pagadas parcialmente
     */
    public function partialPaidInvoices()
    {
        $invoices = Invoice::where('value_status', 3)->get();
        return view('invoices.partial_paid_invoices', compact('invoices'));
    }

    /**
     * Imprime la factura
     */
    public function printInvoice($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.print_invoice', compact('invoice'));
    }

    /**
     * Exportar excel de facturas
     */
    public function export()
    {
        return Excel::download(new InvoicesExport, 'facturas.xlsx');
    }

    /**
     * Establece leidas todas las notidicaciones
     */
    public function markAsReadAll(Request $request)
    {
        $userUnreadNotification = auth()->user()->unreadNotifications;

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
