@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    SCDB | Modificar factura
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Facturas</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Modificar factura</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ url('invoices/update') }}" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        {{-- Fila 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="number" class="control-label">Número de factura</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="number" name="number"
                                    title="Ingrese el número de factura" value="{{ $invoice->number }}" required>
                            </div>

                            <div class="col">
                                <label>Fecha de la factura</label>
                                <input class="form-control fc-datepicker" name="date" placeholder="YYYY-MM-DD" type="text"
                                    value="{{ $invoice->date }}" required>
                            </div>

                            <div class="col">
                                <label>Fecha de vencimiento</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ $invoice->due_date }}" required>
                            </div>

                        </div>

                        {{-- Fila 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Sección</label>
                                <select name="section" class="form-control" onclick="console.log($(this).val())">
                                    <option value=" {{ $invoice->section->id }}">
                                        {{ $invoice->section->name }}
                                    </option>
                                    {{-- para que no se repite la sección por defecto de la factura --}}
                                    @foreach ($sections as $section)
                                        @if ($section->name !== $invoice->section->name)
                                            <option value="{{ $section->id }}"> {{ $section->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="product" class="control-label">Producto</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="{{ $invoice->product }}"> {{ $invoice->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="amount_collection" class="control-label">Importe de la recaudación</label>
                                <input type="text" class="form-control" id="amount_collection" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_collection }}">
                            </div>
                        </div>


                        {{-- Fila 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="amount_commission" class="control-label">Monto de la comisión</label>
                                <input type="text" class="form-control form-control-lg" id="amount_commission"
                                    name="amount_commission" title="Ingrese el monto de la comisión"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->amount_commission }}" required>
                            </div>

                            <div class="col">
                                <label for="discount" class="control-label">Descuento</label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    title="Ingrese el monto del descuento"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required>
                            </div>

                            <div class="col">
                                <label for="IVA" class="control-label">La tasa del impuestos (IVA)</label>
                                <select name="IVA" id="IVA" class="form-control" onchange="myFunction()">
                                    @if ($invoice->rate_vat == '5%')
                                        <option value="5%" selected>5%</option>
                                        <option value="10%">10%</option>
                                    @else
                                        <option value="5%">5%</option>
                                        <option value="10%" selected>10%</option>
                                    @endif

                                </select>
                            </div>

                        </div>

                        {{-- Fila 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="value_IVA" class="control-label">Impuestos IVA</label>
                                <input type="text" class="form-control" id="value_IVA" name="value_IVA"
                                    value="{{ $invoice->value_vat }}" readonly>
                            </div>

                            <div class="col">
                                <label for="total" class="control-label">Total (incluye IVA)</label>
                                <input type="text" class="form-control" id="total" name="total" readonly
                                    value="{{ $invoice->total }}">
                            </div>
                        </div>

                        {{-- Fila 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="note">Observaciones</label>
                                <textarea class="form-control" id="note" name="note" rows="3">
                                                                        {{ $invoice->note }}</textarea>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Guardar datos</button>
                        </div>
                    </form>

                </div>
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
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
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
         * Asigna la fecha de hoy como fecha inicial a la factura
         */
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        /**
         * Cuando de seleciona una sección se extraen automáticamente sus productos
         */
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script>

    <script>
        function myFunction() {
            var amount_commission = parseFloat(document.getElementById("amount_commission").value);
            var discount = parseFloat(document.getElementById("discount").value);
            var IVA = parseFloat(document.getElementById("IVA").value);
            var value_IVA = parseFloat(document.getElementById("value_IVA").value);

            var amount_commission2 = amount_commission - discount;

            if (typeof amount_commission === 'undefined' || !amount_commission) {
                alert('Ingrese el monto de la comisión');
            } else {
                var result = amount_commission2 * IVA / 100;
                var suma = parseFloat(result + amount_commission2);

                VAT = parseFloat(result).toFixed(2);
                total = parseFloat(suma).toFixed(2);

                document.getElementById("value_IVA").value = VAT;
                document.getElementById("total").value = total;
            }
        }

    </script>

@endsection
