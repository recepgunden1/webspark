@extends('backend.layout.app')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold"> </h3>
                <h6 class="font-weight-normal mb-0"> <span class="text-primary"> </span></h6>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Aylık Sipariş Sayısı</p>
                        <p class="fs-30 mb-2">{{$monthTotalCount}}</p>
                        <p>Bu ayın sipariş sayısı</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Aylık Sipariş Kazancı</p>
                        <p class="fs-30 mb-2">{{$monthTotalPrice}}</p>
                        <p>Bu ayın sipariş kazancı</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Sipariş Sayısı</p>
                        <p class="fs-30 mb-2">{{$TotalCount}}</p>
                        <p>Genel toplam sipariş sayısı</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Sipariş Kazancı</p>
                        <p class="fs-30 mb-2">{{$TotalPrice}}</p>
                        <p>Genel toplam sipariş kazancı</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">Order Details</p>
                <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                        <p class="text-muted">Order value</p>
                        <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                        <p class="text-muted">Orders</p>
                        <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                        <p class="text-muted">Users</p>
                        <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                        <p class="text-muted">Downloads</p>
                        <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div>
                </div>
                <canvas id="order-chart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title">Sales Report</p>
                    <a href="#" class="text-info">View all</a>
                </div>
                <p class="font-weight-500">The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc</p>
                <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                <canvas id="sales-chart"></canvas>
            </div>
        </div>
    </div>
</div>--}}
@endsection
