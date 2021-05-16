@extends('layouts.master')
@section('css')
@endsection
@section('title')
    SCDB | Cambio de estado
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Facturas</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Cambiar el estado de pago</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('status-update', ['id' => $invoice->id]) }}" method="post" autocomplete="off">
                        {{ csrf_field() }}
                        {{-- Fila 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="invoice_number" class="control-label">Número de factura</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                                    title="Ingrese el número de factura" value="{{ $invoice->number }}" required readonly>
                            </div>

                            <div class="col">
                                <label>Fecha de factura</label>
                                <input class="form-control fc-datepicker" name="date" placeholder="YYYY-MM-DD" type="text"
                                    value="{{ $invoice->date }}" required readonly>
                            </div>

                            <div class="col">
                                <label>Fecha de vencimiento</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->due_date }}" required readonly>
                            </div>

                        </div>

                        {{-- Fila 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="section" class="control-label">Sección</label>
                                <select name="section" class="form-control" readonly>
                                    <option value=" {{ $invoice->section->id }}">
                                        {{ $invoice->section->name }}
                                    </option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="product" class="control-label">Producto</label>
                                <select id="product" name="product" class="form-control" readonly>
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="amount_collection" class="control-label">Importe de la recaudación</label>
                                <input type="text" class="form-control" id="inputName" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_collection }}" readonly>
                            </div>
                        </div>


                        {{-- Fila 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="amount_commission" class="control-label">Monto de la comisión</label>
                                <input type="text" class="form-control form-control" id="amount_commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_commission }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="discount" class="control-label">Descuento</label>
                                <input type="text" class="form-control form-control" id="discount" name="discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="rate_vat" class="control-label">Tasa del impuesto al valor agregado</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->rate_vat }}">
                                        {{ $invoice->rate_vat }}
                                </select>
                            </div>

                        </div>

                        {{-- Fila 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="value_vat" class="control-label">Impuesto sobre el valor añadido</label>
                                <input type="text" class="form-control" id="value_vat" name="value_vat"
                                    value="{{ $invoice->value_vat }}" readonly>
                            </div>

                            <div class="col">
                                <label for="total" class="control-label">El total incluye impuestos</label>
                                <input type="text" class="form-control" id="total" name="total" readonly
                                    value="{{ $invoice->total }}">
                            </div>
                        </div>

                        {{-- Fila 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="note">Observaciones</label>
                                <textarea class="form-control" id="note" name="note" rows="3" readonly>
                                            {{ $invoice->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="status">Estado de pago</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option selected="true" disabled="disabled">-- Selecciona el estado de pago --</option>
                                    <option value="pagada">pagada</option>
                                    <option value="pagada parcialmente">pagada parcialmente</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Fecha de pago</label>
                                <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Actualizar el estado de pago</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        /**
         * Asigna la fecha de hoy como fecha de pago
         */
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>
@endsection
