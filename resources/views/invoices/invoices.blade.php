@extends('layouts.master')
@section('title')
    SCDB | Lista de facturas
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Facturas</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Lista de
                    facturas</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@section('content')

    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "La factura se ha eliminado correctamente",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('status_update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "El estado del pago se ha actualizado correctamente",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "La factura se ha restaurado correctamente",
                    type: "success"
                })
            }

        </script>
    @endif

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href="invoices/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; Añadir factura</a>

                    <a class="modal-effect btn btn-sm btn-primary" href="{{ url('export-invoices') }}"
                        style="color:white"><i class="fas fa-file-download"></i>&nbsp; Exportación de Excel</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">Número de factura</th>
                                    <th class="border-bottom-0">Fecha de factura</th>
                                    <th class="border-bottom-0">Fecha de vencimiento</th>
                                    <th class="border-bottom-0">Producto</th>
                                    <th class="border-bottom-0">Sección</th>
                                    <th class="border-bottom-0">Descuento</th>
                                    <th class="border-bottom-0">Tasa de impuesto</th>
                                    <th class="border-bottom-0">El monto del impuesto</th>
                                    <th class="border-bottom-0">Total</th>
                                    <th class="border-bottom-0">Estado</th>
                                    <th class="border-bottom-0">Observaciones</th>
                                    <th class="border-bottom-0">Procesos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($invoices) > 0)
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($invoices as $invoice)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <a href="{{ url('invoices-details') }}/{{ $invoice->id }}">
                                                    {{ $invoice->number }} </a>
                                            </td>
                                            <td>{{ $invoice->date }}</td>
                                            <td>{{ $invoice->due_date }}</td>
                                            <td>{{ $invoice->product }}</td>
                                            <td>{{ $invoice->section->name }}</td>
                                            <td>{{ $invoice->discount }}</td>
                                            <td>{{ $invoice->rate_vat }}</td>
                                            <td>{{ $invoice->value_vat }}</td>
                                            <td>{{ $invoice->total }}</td>
                                            <td>
                                                @if ($invoice->value_status == 1)
                                                    <span class="text-success">{{ $invoice->status }}</span>
                                                @elseif($invoice->value_status == 2)
                                                    <span class="text-danger">{{ $invoice->status }}</span>
                                                @else
                                                    <span class="text-warning">{{ $invoice->status }}</span>
                                                @endif
                                            </td>

                                            <td>{{ $invoice->note }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                        type="button">
                                                        Procesos<i class="fas fa-caret-down ml-1"></i>
                                                    </button>
                                                    <div class="dropdown-menu tx-13">
                                                        <a class="dropdown-item"
                                                            href=" {{ url('edit-invoice') }}/{{ $invoice->id }}">
                                                            <i class="text-info fas fa-edit"></i>
                                                            &nbsp;&nbsp;Modificar la factura
                                                        </a>

                                                        <a class="dropdown-item" href="#"
                                                            data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                            data-target="#delete_invoice">
                                                            <i class="text-danger fas fa-trash-alt"></i>
                                                            &nbsp;&nbsp;Eliminar la factura
                                                        </a>

                                                        {{-- cambiar estado solo en casos 'no pagada' y 'pagada parcialmente' --}}
                                                        @if ($invoice->value_status != 1)
                                                            <a class="dropdown-item"
                                                                href="{{ URL::route('status-show', [$invoice->id]) }}">
                                                                <i class=" text-success fas fa-money-bill"></i>
                                                                &nbsp;&nbsp;Cambiar el estado de pago
                                                            </a>
                                                        @endif

                                                        <a class="dropdown-item" href="#"
                                                            data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                            data-target="#transfer_invoice"><i
                                                                class="text-warning fas fa-exchange-alt"></i>
                                                            &nbsp;&nbsp;Transferir al archivo
                                                        </a>

                                                        <a class="dropdown-item"
                                                            href="print-invoice/{{ $invoice->id }}"><i
                                                                class="text-success fas fa-print"></i>
                                                            &nbsp;&nbsp;Imprimir la factura
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="13" class="text-center">No hay niguna factura</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->

    <!-- Eliminar factura -->
    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar la factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{-- Si hay algun problema me lleva a 'test' --}}
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    ¿Estás seguro del proceso de eliminación?
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archivar factura -->
    <div class="modal fade" id="transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Archivar la factura</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                </div>
                <div class="modal-body">
                    ¿Está seguro del proceso de archivo?
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    <input type="hidden" name="code" id="code" value="2">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        /*
         * Asigna el id al input hidden en el modal de eliminar
         */
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>

    <script>
        /*
         * Asigna el id al input hidden en el modal de archivar
         */
        $('#transfer_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })

    </script>
@endsection
