@extends('layouts.master')
@section('css')
    <style>
        /* Cuando imprime se oculta el botón de imprimir */
        @media print {
            #print_button {
                display: none;
            }
        }

    </style>
@endsection

@section('title')
    SCDB | Vista previa de la factura
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Facturas</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Vista previa de la factura</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">Factura de cobranza</h1>
                            <div class="billed-from">
                                <h6>BootstrapDash, Inc.</h6>
                                <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                    Tel No: 324 445-4544<br>
                                    Email: youremail@companyname.com</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="invoice-title">Facturado a:</label>
                                <div class="billed-to">
                                    <h6>Juan Dela Cruz</h6>
                                    <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                        Tel No: 324 445-4544<br>
                                        Email: youremail@companyname.com</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="invoice-title">Información de la factura:</label>
                                <p class="invoice-info-row"><span>Número de factura</span>
                                    <span>{{ $invoice->number }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Fecha de lanzamiento</span>
                                    <span>{{ $invoice->date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Fecha de vencimiento</span>
                                    <span>{{ $invoice->due_date }}</span>
                                </p>
                                <p class="invoice-info-row"><span>Sección</span>
                                    <span>{{ $invoice->section->name }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-10p">#</th>
                                        <th class="wd-40p">Producto</th>
                                        <th class="tx-center">Importe de la recaudación</th>
                                        <th>Monto de la comisión</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="tx-12">{{ $invoice->product }}</td>
                                        <td class="tx-center">{{ number_format($invoice->amount_collection, 2) }}€</td>
                                        <td>{{ number_format($invoice->amount_commission, 2) }}€</td>
                                        @php
                                            $total = $invoice->amount_collection + $invoice->amount_commission;
                                        @endphp
                                        <td>
                                            {{ number_format($total, 2) }}€
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="valign-middle" colspan="2" rowspan="4"></td>
                                        <td class="tx-uppercase tx-bold ">Total</td>
                                        <td colspan="2"> {{ number_format($total, 2) }}€</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-uppercase tx-bold">Tasa de impuesto ({{ $invoice->rate_vat }})</td>
                                        <td colspan="2"> {{ number_format($invoice->value_vat, 2) }}€</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-uppercase tx-bold">Valor de descuento</td>
                                        <td colspan="2"> {{ number_format($invoice->discount, 2) }}€</td>
                                    </tr>
                                    <tr>
                                        <td class="tx-uppercase tx-bold tx-inverse">El total incluye impuestos</td>
                                        <td colspan="2">
                                            <h4 class="invoice-title tx-bold">{{ number_format($invoice->total, 2) }}€
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">

                        <button class="btn btn-danger float-right mt-3 mr-2" id="print_button" onclick="printInvoice()"> <i
                                class="mdi mdi-printer ml-1">Imprimir</i></button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <script type="text/javascript">
        /**
         * Imprime la factura
         */
        function printInvoice() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

@endsection
