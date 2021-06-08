@extends('layouts.master')
@section('title')
    SCDB | Panel de control
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Bienvenido de nuevo!</h2>
                <p class="mg-b-0">Sociedad de cobro de duedas para bancos - SCDB</p>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-secondary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">TOTAL DE FACTURAS</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{-- total de facturas --}}
                                    {{ number_format(\App\Invoice::sum('total'), 2) }}€
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    {{-- Numero de facturas --}}
                                    {{ \App\Invoice::count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>

        {{-- Facturas pagadas --}}
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">FACTURAS PAGADAS</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                    {{ number_format(\App\Invoice::where('value_status', 1)->sum('total'), 2) }}€

                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">

                                    {{ \App\Invoice::where('value_status', 1)->count() }}

                                </p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">

                                    @php
                                        $total = \App\Invoice::count();
                                        $total_pagadas = \App\Invoice::where('value_status', 1)->count();
                                        if ($total_pagadas == 0) {
                                            echo $total_pagadas = 0;
                                        } else {
                                            echo $total_pagadas = number_format(($total_pagadas / $total) * 100, 2) . '%';
                                        }
                                    @endphp

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

        {{-- Facturas no pagadas --}}
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">FACTURAS NO PAGADAS</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\Invoice::where('value_status', 2)->sum('total'), 2) }}€
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    {{ \App\Invoice::where('value_status', 2)->count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-down text-white"></i>
                                <span class="text-white op-7">

                                    @php
                                        $total = \App\Invoice::count();
                                        $total_no_pagadas = \App\Invoice::where('value_status', 2)->count();
                                        if ($total_no_pagadas == 0) {
                                            echo $total_no_pagadas = 0;
                                        } else {
                                            echo number_format($total_no_pagadas = ($total_no_pagadas / $total) * 100, 2) . '%';
                                        }
                                    @endphp

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>

        {{-- Facturas pagadas parcialmente --}}
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">FACTURAS PAGADAS PARCIALMENTE</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    {{ number_format(\App\Invoice::where('value_status', 3)->sum('total'), 2) }}€
                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    {{ \App\Invoice::where('value_status', 3)->count() }}
                                </p>
                            </div>
                            <span class="float-right my-auto ml-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">

                                    @php
                                        $total = \App\Invoice::count();
                                        $total_pagadas = \App\Invoice::where('value_status', 3)->count();
                                        if ($total_pagadas == 0) {
                                            echo $total_pagadas = 0 . '%';
                                        } else {
                                            echo $total_pagadas = number_format(($total_pagadas / $total) * 100, 2) . '%';
                                        }
                                    @endphp

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->
    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Porcentaje estadístico detallado de facturas por secciones</h4>
                    </div>
                </div>
                <div class="card-body" style="width: 100%">
                    {!! $chartjs->render() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">Porcentaje estadístico general de las facturas</label>
                <div class="" style="width: 100%; margin-top: 20px;">
                    {!! $chartjs_2->render() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
