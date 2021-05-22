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
    SCDB | Añadir factura
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Facturas</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Añadir factura
                </span>
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

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
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
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}

                        {{-- Fila 1 --}}
                        <div class="row">
                            <div class="col">
                                <label for="number" class="control-label">Número de factura</label>
                                <input type="text" class="form-control" id="number" name="number"
                                    title="Ingrese el número de factura" required>
                            </div>

                            <div class="col">
                                <label>Fecha de inicio</label>
                                <input class="form-control fc-datepicker" name="date" placeholder="YYYY-MM-DD" type="text"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label>Fecha de vencimiento</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                        </div>

                        {{-- Fila 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="section" class="control-label">Sección</label>
                                <select name="section" class="form-control" onclick="console.log($(this).val())"
                                    onchange="console.log('está cambiando')">

                                    <option value="" selected disabled>Selecciona la sección</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label for="product" class="control-label">Producto</label>
                                <select id="product" name="product" class="form-control">
                                    <option value="" selected disabled>Selecciona el producto</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="amount_collection" class="control-label">Importe de la recaudación</label>
                                <input type="text" class="form-control" id="amount_collection" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- Fila 3 --}}
                        <div class="row">
                            <div class="col">
                                <label for="amount_commission" class="control-label">Monto de la comisión</label>
                                <input type="text" class="form-control" id="amount_commission" name="amount_commission"
                                    title="Ingrese el monto de la comisión"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="discount" class="control-label">Descuento</label>
                                <input type="text" class="form-control" id="discount" name="discount"
                                    title="Ingrese el monto del descuento"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col">
                                <label for="IVA" class="control-label">La tasa del impuestos (IVA)</label>
                                <select name="IVA" id="IVA" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>Seleccione IVA</option>
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>
                        </div>

                        {{-- Fila 4 --}}
                        <div class="row">
                            <div class="col">
                                <label for="value_IVA" class="control-label">Impuestos IVA</label>
                                <input type="text" class="form-control" id="value_IVA" name="value_IVA" readonly>
                            </div>

                            <div class="col">
                                <label for="total" class="control-label">Total (incluye IVA)</label>
                                <input type="text" class="form-control" id="total" name="total" readonly>
                            </div>
                        </div>

                        {{-- Fila 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="note">Observaciones</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* Fórmula de apego: pdf, jpeg ,.jpg , png </p>
                        <label>Archivos adjuntos</label>

                        <div class="col-sm-12 col-md-12">
                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
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
                var sectionId = $(this).val();
                if (sectionId) {
                    $.ajax({
                        url: "{{ URL::to('section') }}/" + sectionId,
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
        /**
         * Calcula el impuesto sobre el valor añadido y el total más los impuestos dependiendo del IVA
         */
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
