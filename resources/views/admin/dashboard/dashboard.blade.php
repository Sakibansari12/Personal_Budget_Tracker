@extends('admin.layouts.main')
@section('content')
<!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card" style="background: linear-gradient(90deg, #00d2ff 0%, #3a47d5 100%); color: #fff; padding: 15px; border-radius: 10px;">
                                        <a href="" class="text-white" style="text-decoration: none;">
                                            <h3>{{ $income }}</h3>
                                            <h3>Total Income</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card" style="background: linear-gradient(90deg, #00d2ff 0%, #3a47d5 100%); color: #fff; padding: 15px; border-radius: 10px;">
                                        <a href="" class="text-white" style="text-decoration: none;">
                                            <h3>{{ $expenses }}</h3>
                                            <h3>Total Expenses</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card" style="background: linear-gradient(90deg, #00d2ff 0%, #3a47d5 100%); color: #fff; padding: 15px; border-radius: 10px;">
                                        <a href="" class="text-white" style="text-decoration: none;">
                                            <h3>{{ $balance }}</h3>
                                            <h3>Total Balance</h3>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
@endsection