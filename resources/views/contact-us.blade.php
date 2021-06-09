@extends('layouts.master')
@section('title')
    SCDB | Contacta con nosotros
@stop
@section('css')
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Contacta con nosotros</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Redactar correo</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (session()->has('Sended'))
        <script>
            window.onload = function() {
                notif({
                    msg: "Tu mensaje se envió correctamente!",
                    type: "success"
                })
            }

        </script>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="/contact-us" method="post" enctype="multipart/form-data" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row align-items-center">
                                <label class="col-sm-2">Asunto</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="subject" placeholder="Descripción breve">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row ">
                                <label class="col-sm-2">Mensaje</label>
                                <div class="col-sm-10">
                                    <textarea rows="10" class="form-control" name="message"
                                        placeholder="Escribe tu mensaje ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-danger btn-space">Enviar</button>
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
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
@endsection
